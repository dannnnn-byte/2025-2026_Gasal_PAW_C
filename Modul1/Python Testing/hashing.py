# list = [15,11,27,8,20]

# hash_table = [[None], [None], ...]
# for i in range(5):
#   hash_table.append([None])

#   for j in list:
#     temp = j % 5
#     if hash_table[temp][0] == None:
#       hash_table[temp] = j
#     else:
#       while hash_table[temp] is not None:
#         temp = (temp + 1) % 5
#       hash_table[temp] = j

# print(hash_table)  
# list = ["Username123", "Udin123"]


# for j in list:
#   temp = j % 5
#   hash_table[temp] = j

# print(hash_table) 

# list = ["Username123", "Udin123"]

# hash_table = []
# for i in range():
#   hash_table.append([None])

# total = 0
# for j in list:
#     for char in j :
#         temp = ord(char)
# print(temp)   
 
# list = [15,11,27,8,20]
# def cari (hash,key):
#     temp = key % len(hash)
#     for i in hash :
#         if hash[temp] == key:
#             return temp
#         else:
#             temp = (temp + 1) % len(hash) 
#     if i == key:
#         return temp
# hash = [None] * 5
# for i in list:
#     temp = i % len(hash)
#     if hash[temp] == None:
#         hash[temp] = i
#     else:
#         while hash[temp] is not None:
#             temp = (temp + 1) % len(hash)
#         hash[temp] = i
# print(hash)
# print(cari(hash, 20))
# print(cari(hash, 15))
# print(cari(hash, 11))

list = [15,11,27,8]
hash_table = []
for i in range(7):
    hash_table.append([None])

for j in list:
    temp = j % 7
    if hash_table[temp][0] == None:
        hash_table[temp] [0] = j
    else:
        hash_table[temp].append(j)
print(hash_table)

def cari(hash, key):
    temp = key % len(hash)
    for i in hash[temp]:
        if i == key:
            return temp
    return None 
print(cari(hash_table, 20))
print(cari(hash_table, 15)) 
    