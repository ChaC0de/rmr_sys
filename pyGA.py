import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="rmr_sys"
)

mycursor = mydb.cursor()

# sql = "SELECT ansValue FROM form_answer WHERE st_ID = '1'"

# mycursor.execute(sql)

# myresult = mycursor.fetchall()

# terget_arr = []
# for x in myresult:
#     terget_arr.append(x[0])

# print(terget_arr)



sql1 = "SELECT ansValue FROM form_answer INNER JOIN tb_student ON form_answer.st_ID = tb_student.st_ID WHERE tb_student.st_sex = 'เพศหญิง'"

mycursor.execute(sql1)

myresult = mycursor.fetchall()

input_arr = []
for x in myresult:
    input_arr.append(x)

print()



for value in myresult:
  print(value.st_sex)

# import random 

# # ข้อมูลเริ่มต้น
# student_data = [
#     [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
#     [10, 9, 8, 7, 6, 5, 4, 3, 2, 1],
#     [5, 5, 5, 5, 5, 5, 5, 5, 5, 5],
#     [8, 8, 8, 8, 8, 8, 8, 8, 8, 8],
#     [3, 3, 3, 3, 3, 3, 3, 3, 3, 3]
# ]

# # สร้างคำตอบ
# answer = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]

# # สร้างคำตอบที่ถูกต้อง
# def create_answer():
#     answer = []
#     for i in range(10):
#         answer.append(random.randint(1, 10))
#     return answer

# # คำนวณค่าความเหมาะสม
# def fitness_function(student_data, answer):
#     fitness = []
#     for i in range(len(student_data)):
#         score = 0
#         for j in range(len(student_data[i])):
#             if student_data[i][j] == answer[j]:
#                 score += 1
#         fitness.append(score)
#     return fitness

# # คำนวณค่าความน่าจะเป็น
# def probability(fitness):
#     probability = []
#     total = sum(fitness)
#     for i in range(len(fitness)):
#         probability.append(fitness[i]/total)
#     return probability

# # คำนวณค่าสะสม
# def cumulative(probability):
#     cumulative = []
#     sum = 0
#     for i in range(len(probability)):
#         sum += probability[i]
#         cumulative.append(sum)
#     return cumulative

# # สร้างรายการเลือก
# def selection(cumulative):
#     selection = []
#     for i in range(len(cumulative)):
#         selection.append(random.random())
#     return selection


# # สร้างรายการลูก
# def crossover(selection, student_data):
#     crossover = []
#     for i in range(len(selection)):
#         for j in range(len(selection)):
#             if selection[i] < selection[j]:
#                 crossover.append(student_data[i])
#             else:
#                 crossover.append(student_data[j])
#     return crossover

# def getStudentData( student_data):
#     student_data = []
#     for i in range(5):
#         student_data.append(create_answer())
#     return student_data

# def getAnswer( student_data):
#     answer = create_answer()
#     return answer

# def getFitness( student_data, answer):
#     fitness = fitness_function(student_data, answer)
#     return fitness

# def getProbability( fitness):
#     probability = probability(fitness)
#     return probability

# def getCumulative( probability):
#     cumulative = cumulative(probability)
#     return cumulative

# def getSelection( cumulative):
#     selection = selection(cumulative)
#     return selection

# def getCrossover( selection, student_data):
#     crossover = crossover(selection, student_data)
#     return crossover

# def getMutation( crossover):
#     mutation = []
#     for i in range(len(crossover)):
#         for j in range(len(crossover[i])):
#             if random.random() < 0.1:
#                 mutation.append(random.randint(1, 10))
#             else:
#                 mutation.append(crossover[i][j])
#     return mutation

# def getBest( student_data, answer):
#     fitness = fitness_function(student_data, answer)
#     best = fitness.index(max(fitness))
#     return best

# def getWorst( student_data, answer):
#     fitness = fitness_function(student_data, answer)
#     worst = fitness.index(min(fitness))
#     return worst

# def getAverage( student_data, answer):
#     fitness = fitness_function(student_data, answer)
#     average = sum(fitness)/len(fitness)
#     return average


# student_data = getStudentData(student_data)
# answer = getAnswer(student_data)
# fitness = getFitness(student_data, answer)
# probability = getProbability(fitness)
# cumulative = getCumulative(probability)
# selection = getSelection(cumulative)
# crossover = getCrossover(selection, student_data)
# mutation = getMutation(crossover)
# mutation_result = [mutation[i:i+10] for i in range(0, len(mutation), 10)
#                      if len(mutation[i:i+10]) == 10]
# best = getBest(student_data, answer)
# worst = getWorst(student_data, answer)
# average = getAverage(student_data, answer)

# print("student_data = ", student_data)
# print("answer = ", answer)
# print("fitness = ", fitness)
# print("probability = ", probability)
# print("cumulative = ", cumulative)
# print("selection = ", selection)
# print("crossover = ", crossover)
# print("mutation = ", mutation)
# print("mutation_result = ", mutation_result)
# print("best = ", best)
# print("worst = ", worst)
# print("average = ", average)