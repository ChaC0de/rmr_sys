import numpy as np
import mysql.connector

def cosine_similarity(answer, solution):
    """
    คำนวณค่า cosine similarity ระหว่าง answer และ solution
    """
    dot_product = np.dot(answer, solution)
    norm_answer = np.linalg.norm(answer)
    norm_solution = np.linalg.norm(solution)
    similarity = dot_product / (norm_answer * norm_solution)
    return similarity

def get_solution_from_database(mycursor, u_ID):
    mycursor.execute("SELECT ansValue FROM form_answer WHERE u_ID = %s AND ansValue != '0' ORDER BY ans_ID ASC", (u_ID,))
    myresult = mycursor.fetchall()
    solution = []
    for x in myresult:
        solution.append(x[0])
    return solution

    

def get_answers_from_database(mycursor, record_count):
    answers = []
    for person_index in range(1, record_count + 1):
        data_query = "SELECT form_answer.ansValue FROM form_answer WHERE form_answer.u_ID = %s AND form_answer.ansValue != '0' ORDER BY ans_ID ASC"
        mycursor.execute(data_query, (person_index,))
        myresult = mycursor.fetchall()
        answer = []
        for x in myresult:
            answer.append(x[0])
        answers.append(answer)
    return answers

def main():
    u_ID = 1  # กำหนดค่า u_ID
    
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="rmr_sys"
    )
    
    mycursor = mydb.cursor()
    
    count_query = "SELECT MAX(u_ID) FROM form_answer;"
    mycursor.execute(count_query)
    record_count = mycursor.fetchone()[0]
    
    solution = get_solution_from_database(mycursor, u_ID)
    print("Solution: ", solution)

    
    answers = get_answers_from_database(mycursor, record_count)
    # print("Answers: ", answers)

    similarities = []
    for i, answer in enumerate(answers):
        similarity = cosine_similarity(answer, solution)
        similarities.append((i, similarity, answer))
    
    similarities.sort(key=lambda x: (x[1], x[0]), reverse=True)
    
    result = []
    # for idx, sim, answer in similarities:
    #     result.append({
    #         "Array": idx + 1,
    #         "Similarity": sim * 100,
    #         "Answer": answer,
    #     })
    for u_ID, sim, answer in similarities:
        result.append({
            "u_ID": u_ID + 1,
            "Similarity": sim * 100,
            "Answer": answer,
    })
        
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

        
    
    
    return result




if __name__ == "__main__":
    result = main()
    for item in result:
        print(f"u_ID: {item['u_ID']},Similarity: {item['Similarity']}, Answer: {item['Answer']}")


# if __name__ == "__main__":
#     result = main()
#     # result_length = len(result)
#     # print("จำนวนของอาร์เรย์ result:", result_length)
#     print(result)
