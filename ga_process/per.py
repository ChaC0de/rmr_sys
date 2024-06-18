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

myresult_query = "SELECT result, my_ID FROM tb_result WHERE my_ID = '%s' AND u_ID = '%s'"
mycursor.execute(myresult_query, (9, 9))
myresult_query = []
myresult = mycursor.fetchall()
for x in myresult:
    myresult_query.append(x[0])
    my_ID = x[1]

print("myresult: {myresult}".format(myresult=myresult_query))
print("my_ID: {my_ID}".format(my_ID=my_ID))


# count_result = "SELECT MAX(u_ID)FROM tb_result WHERE my_ID = 5;"
# mycursor.execute(count_result)
# result_count = mycursor.fetchone()[0]

# for person_index in range(1, result_count + 1):

result_query = "SELECT result, u_ID FROM tb_result WHERE my_ID = %s AND u_ID = %s"
mycursor.execute(result_query, (9, 5))
result = []
myresult1 = mycursor.fetchall()
for x in myresult1:
    result.append(x[0])
u_ID = x[1]
print("result: {result}".format(result=result))
print("u_ID: {u_ID}".format(u_ID=u_ID))

percentage = 100 - (abs(myresult_query[0] - result[0]) / myresult_query[0] * 100)
r_percentage = round(percentage, 2)
print("percentage: {percentage}".format(percentage=r_percentage))

# if result != 0 :
#         select_percent = "SELECT * FROM tb_percent WHERE my_ID = '%s' AND u_ID = '%s'"
#         mycursor.execute(select_percent, (my_ID, u_ID))
#         existing_percent = mycursor.fetchone()

#         if existing_percent:
#             update_percent = "UPDATE tb_percent SET r_percentage = %s WHERE my_ID = %s AND u_ID = %s"
#             update_values = (r_percentage, my_ID, u_ID)
#             try:
#                 mycursor.execute(update_percent, update_values)
#                 mydb.commit()
#                 print('อัพเดตข้อมูลเรียบร้อยแล้ว')
#             except mysql.connector.Error as err:
#                 print(f"Error: {err}")
#                 mydb.rollback()
#                 print('อัพเดตข้อมูลผิดพลาด')
#         else:
#             insert_percent = "INSERT INTO tb_percent (id, my_ID, u_ID, r_percentage) VALUES (%s, %s, %s, %s)"
#             insert_values = (None, my_ID, u_ID, r_percentage)
#             try:
#                 mycursor.execute(insert_percent, insert_values)
#                 mydb.commit()
#                 print('เพิ่มข้อมูลเรียบร้อยแล้ว')
#             except mysql.connector.Error as err:
#                 print(f"Error: {err}")
#                 mydb.rollback()
#                 print('เพิ่มข้อมูลผิดพลาด')




