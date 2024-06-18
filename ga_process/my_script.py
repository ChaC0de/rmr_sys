from flask import Flask, jsonify, request
from flask_cors import CORS
import pygad
import numpy
import mysql.connector

app = Flask(__name__)
CORS(app)
CORS(app, resources={r"/rmr_sys/ga_process/run_script": {"origins": "*"}})

@app.route('/rmr_sys/ga_process/run_script', methods=['GET'])
def run_script():
    mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="rmr_sys"
    )
    u_ID = request.args.get('u_ID')
    last_fitness = 0
    mycursor = mydb.cursor()    
    
    try:

        mycursor.execute("SELECT ansValue, u_ID FROM form_answer WHERE u_ID = %s AND ansValue != '0' ORDER BY ans_ID ASC", (u_ID,))
        
        myresult = mycursor.fetchall()

        target_arr = []
        for x in myresult:
            target_arr.append(x[0])

        my_ID = int(myresult[0][1])
        print("my_ID: " + str(myresult[0][1]))

        desired_output = target_arr
        print("My output: {desired_output}".format(desired_output=desired_output))

        print("################################################################")


        #เลือกข้อมูลที่จะใช้ในการทำ GA จากฐานข้อมูล โดยเลือกเพศหญิง
        count_query = "SELECT MAX(u_ID)FROM form_answer;"
        mycursor.execute(count_query)
        record_count = mycursor.fetchone()[0]

        # for person_index in range(1, record_count + 1 ):
        for person_index in range(1, 50 + 1 ):
            
            data_query = "SELECT form_answer.ansValue, tb_student.u_ID, tb_student.st_name, tb_student.st_sex FROM form_answer INNER JOIN tb_student ON form_answer.u_ID = tb_student.u_ID WHERE tb_student.u_ID = %s AND form_answer.ansValue != '0' ORDER BY ans_ID ASC"
            mycursor.execute(data_query, (person_index,))
            myresult1 = mycursor.fetchall()

            function_inputs = []
            u_ID = None
            st_name = None
            st_sex = None
            for x in myresult1:
                function_inputs.append(x[0])
                u_ID = (x[1])
                st_name = (x[2])
                st_sex = (x[3])

            print("u_ID: {u_ID}".format(u_ID=u_ID))
            print("st_name: {st_name}".format(st_name=st_name))
            print("st_sex: {st_sex}".format(st_sex=st_sex))
            print("Function inputs: {function_inputs}".format(function_inputs=function_inputs))
            print("################################################################")

            def fitness_func(ga_instance, solution, solution_idx):
                output = numpy.sum(solution*function_inputs)
                # fitness = numpy.sum(numpy.abs(output - desired_output))
                fitness = 1.0 / (numpy.abs(output - desired_output))
                return fitness

            num_generations = 50
            num_parents_mating = 4

            # sol_per_pop = 25
            sol_per_pop = 25


            num_genes = len(function_inputs)

            def callback_generation(ga_instance):
                nonlocal last_fitness
                print("Generation = {generation}".format(generation=ga_instance.generations_completed))
                print("Fitness    = {fitness}".format(fitness=ga_instance.best_solution()[1]))
                print("Change     = {change}".format(change=ga_instance.best_solution()[1] - last_fitness))
                last_fitness = ga_instance.best_solution()[1]
                
            ga_instance = pygad.GA(num_generations=num_generations,
                                num_parents_mating=num_parents_mating, 
                                fitness_func=fitness_func,
                                sol_per_pop=sol_per_pop,
                                random_seed = 400000,
                                num_genes=num_genes,
                                on_generation=callback_generation,
                                    init_range_low=1,
                                    init_range_high=3,
                                    crossover_type="uniform",
                                )
            ga_instance.run()

            # ga_instance.plot_fitness()

            solution, solution_fitness, solution_idx = ga_instance.best_solution()
            print("Parameters of the best solution: {solution}".format(solution=solution))
            print("Fitness value of the best solution: {solution_fitness}".format(solution_fitness=solution_fitness))
            print("Index of the best solution: {solution_idx}".format(solution_idx=solution_idx))
            
            if ga_instance.best_solution_generation != -1:
                print("Best fitness value reached after {best_solution_generation} generations.".format(best_solution_generation=ga_instance.best_solution_generation))
            
            prediction = numpy.sum(numpy.array(solution)*numpy.array(function_inputs))
            rounded_prediction = round(prediction, 5)
            print("Predicted output based on the best solution : {prediction:.5f}".format(prediction=rounded_prediction))
            result = rounded_prediction

            if result != 0:
                select_query = "SELECT * FROM tb_result WHERE my_ID = %s AND u_ID = %s"
                mycursor.execute(select_query, (my_ID, u_ID))
                existing_result = mycursor.fetchone()

                if existing_result:
                    update_sql = "UPDATE tb_result SET result = %s WHERE my_ID = %s AND u_ID = %s"
                    update_values = (result, my_ID, u_ID)
                    try:
                        mycursor.execute(update_sql, update_values)
                        mydb.commit()
                        print('อัพเดตข้อมูลเรียบร้อยแล้ว')
                    except mysql.connector.Error as err:
                        print(f"Error: {err}")
                        mydb.rollback()
                        print('อัพเดตข้อมูลผิดพลาด')
                else:
                    insert_sql = "INSERT INTO tb_result (id, my_ID, u_ID, student_Name, st_sex, result, date) VALUES (%s, %s, %s, %s, %s, %s ,NOW())"
                    insert_values = (None, my_ID, u_ID, st_name, st_sex, result)
                    try:
                        mycursor.execute(insert_sql, insert_values)
                        mydb.commit()
                        print('เพิ่มข้อมูลเรียบร้อยแล้ว')
                    except mysql.connector.Error as err:
                        print(f"Error: {err}")
                        mydb.rollback()
                        print('เพิ่มข้อมูลผิดพลาด')

    except Exception as e:
        print(f"Error: {e}")

    mycursor.close()
    mydb.close()

    mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="rmr_sys"
    )
    u_ID = request.args.get('u_ID')

    mycursor = mydb.cursor()

    try:
        mycursor.execute("SELECT result, my_ID FROM tb_result WHERE my_ID = %s AND u_ID = %s", (my_ID, u_ID))
        myresult = mycursor.fetchall()
        myresult_query = []
        for x in myresult:
            myresult_query.append(x[0])
            my_ID = x[1]
        print("myresult_query: {myresult_query}".format(myresult_query=myresult_query))
        print("my_ID: {my_ID}".format(my_ID=my_ID))

        count_result = "SELECT MAX(u_ID)FROM tb_result WHERE my_ID = %s"
        mycursor.execute(count_result, (my_ID,))
        record = mycursor.fetchone()[0]

        # for i in range(1, record + 1):
        for i in range(1, 50 + 1 ):

            result_query = "SELECT result, u_ID FROM tb_result WHERE  my_ID = %s AND u_ID = %s"
            mycursor.execute(result_query, (my_ID, i))
            myresult1 = mycursor.fetchall()
            result = []
            u_ID = None
            for x in myresult1:
                result.append(x[0])
                u_ID = (x[1])
            print("result: {result}".format(result=result))
            print("u_ID: {u_ID}".format(u_ID=u_ID))

            percentage = 100 - (abs(myresult_query[0] - result[0]) / myresult_query[0] * 100)
            r_percentage = round(percentage, 2)
            # print("percentage: {percentage}".format(percentage=r_percentage))

            if result != 0 :
                    select_percent = "SELECT * FROM tb_percent WHERE my_ID = '%s' AND u_ID = '%s'"
                    mycursor.execute(select_percent, (my_ID, u_ID))
                    existing_percent = mycursor.fetchone()

                    if existing_percent:
                        update_percent = "UPDATE tb_percent SET r_percentage = %s WHERE my_ID = %s AND u_ID = %s"
                        update_values = (r_percentage, my_ID, u_ID)
                        try:
                            mycursor.execute(update_percent, update_values)
                            mydb.commit()
                            print('อัพเดตข้อมูลเรียบร้อยแล้ว')
                        except mysql.connector.Error as err:
                            print(f"Error: {err}")
                            mydb.rollback()
                            print('อัพเดตข้อมูลผิดพลาด')
                    else:
                        insert_percent = "INSERT INTO tb_percent (id, my_ID, u_ID, r_percentage) VALUES (%s, %s, %s, %s)"
                        insert_values = (None, my_ID, u_ID, r_percentage)
                        try:
                            mycursor.execute(insert_percent, insert_values)
                            mydb.commit()
                            print('เพิ่มข้อมูลเรียบร้อยแล้ว')
                        except mysql.connector.Error as err:
                            print(f"Error: {err}")
                            mydb.rollback()
                            print('เพิ่มข้อมูลผิดพลาด')
    except Exception as e:
        print(f"Error: {e}")

    mycursor.close()
    mydb.close()
        
    return jsonify({'result': result})

if __name__ == '__main__':
    app.run(debug=True, port=5000)  
    # ใช้พอร์ต 3306 สำหรับ Flask
# filename = 'genetic'
# ga_instance.save(filename=filename)


# loaded_ga_instance = pygad.load(filename=filename)
# loaded_ga_instance.plot_fitness()     
