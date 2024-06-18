import pygad
import numpy
import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="rmr_sys"
)
mycursor = mydb.cursor()
last_fitness = 0
# เลือกข้อมูลที่จะใช้ในการทำ GA จากฐานข้อมูล u_ID = 1 คือ ธัญพร แก้ววิไล

mycursor.execute("SELECT ansValue, u_ID FROM form_answer WHERE u_ID = '1' AND ansValue != '0'")
myresult = mycursor.fetchall()

target_arr = []
for x in myresult:
    target_arr.append(x[0])

my_ID = myresult[0][1]
print("my_ID: " + str(myresult[0][1]))


desired_output = target_arr
print("My output: {desired_output}".format(desired_output=desired_output))

print("################################################################")


#เลือกข้อมูลที่จะใช้ในการทำ GA จากฐานข้อมูล
# count_query = "SELECT MAX(u_ID)FROM form_answer;"
# mycursor.execute(count_query)
# record_count = mycursor.fetchone()[0]


# for person_index in range(1, record_count + 1):
data_query = "SELECT form_answer.ansValue, tb_student.u_ID, tb_student.st_name, tb_student.st_sex FROM form_answer INNER JOIN tb_student ON form_answer.u_ID = tb_student.u_ID WHERE tb_student.u_ID = 1 AND form_answer.ansValue != '0'"
mycursor.execute(data_query)
myresult1 = mycursor.fetchall()

function_inputs = []
u_ID = None
st_name = None
st_sex = None
for x in myresult1:
    function_inputs.append(x[0])
    u_ID = x[1]
    st_name = x[2]
    st_sex = x[3]

print("u_ID: {u_ID}".format(u_ID=u_ID))
print("st_name: {st_name}".format(st_name=st_name))
print("st_sex: {st_sex}".format(st_sex=st_sex))
print("Function inputs: {function_inputs}".format(function_inputs=function_inputs))
print("################################################################")

def fitness_func(ga_instance, solution, solution_idx):
    output = numpy.sum(solution*function_inputs)
    # fitness = 1.0 / (numpy.abs(output - desired_output))
    fitness = 1.0 / (numpy.abs(output - desired_output) + 0.000001)

    return fitness

num_generations = 50
num_parents_mating = 4

sol_per_pop = 50

num_genes = len(function_inputs)

def callback_generation(ga_instance):
    global last_fitness
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

ga_instance.plot_fitness()

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

    # sql = "INSERT INTO tb_result (id,my_ID, u_ID, student_Name,st_sex, result) VALUES (%s, %s, %s, %s, %s, %s)"
    # values = (None, my_ID, u_ID, st_name, st_sex, result)
    # if result != 0:
    #     try:
    #         mycursor.execute(sql, values)
    #         mydb.commit()
    #         print('เพิ่มข้อมูล เรียบร้อยแล้ว')
    #     except mysql.connector.Error as err:
    #         print(f"Error: {err}")
    #         mydb.rollback()
    #         print('เพิ่มข้อมูล ผิดพลาด')


    # filename = 'genetic'
    # ga_instance.save(filename=filename)


    # loaded_ga_instance = pygad.load(filename=filename)
    # loaded_ga_instance.plot_fitness()

