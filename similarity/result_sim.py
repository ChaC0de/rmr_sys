import numpy as np

def cosine_similarity(answer, solution):
    """
    คำนวณค่า cosine similarity ระหว่าง answer และ solution
    """
    dot_product = np.dot(answer, solution)
    norm_answer = np.linalg.norm(answer)
    norm_solution = np.linalg.norm(solution)
    similarity = dot_product / (norm_answer * norm_solution)
    return similarity

def main():
    # เฉลย
    solution = np.random.randint(1, 4, size=10)
    print("Solution: ", solution)
    
    # คำตอบ
    answers = []
    for i, answer in enumerate(np.random.randint(1, 4, size=(10, 10))):
        answers.append(answer)
        print("Array", i + 1, ": ", answer)

    
    # คำนวณความคล้ายโดยใช้ cosine similarity
    similarities = []
    for i, answer in enumerate(answers):
        similarity = cosine_similarity(answer, solution)
        similarities.append((i, similarity, answer))  # เก็บ index ของ array และค่า cosine similarity ด้วยเพื่อให้สามารถระบุได้
    
    # เรียงลำดับความคล้ายโดยใช้ % ความคล้ายคลึง และ index
    similarities.sort(key=lambda x: (x[1], x[0]), reverse=True)
    
    # แสดงผลลัพธ์ที่เรียงลำดับและระบุ Array ที่เท่าไร พร้อมกับค่า cosine similarity
    for idx, sim, answer in similarities:
        print(f"Array {idx+1}: Similarity = {sim * 100:.2f}%, Answer: {answer}")

    return similarities

if __name__ == "__main__":
    similarities = main()
