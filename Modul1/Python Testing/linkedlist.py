# class hewan :
#     def __init__(self, nama, kaki, ekor):
#         self.nama = nama
#         self.kaki = kaki
#         self.ekor = ekor
#     def GantiNama(self, nama):
#         self.nama = nama 
#     def GantiKaki(self, kaki):
#         self.kaki = kaki
#     def GantiEkor(self, ekor):
#         self.ekor = ekor                 

# sapi = hewan("sapi", 4, 1)
# print(sapi.kaki)

# sapi.GantiNama("babi")
# print(sapi.nama)

# sapi.GantiKaki(3)
# print(sapi.kaki)

# sapi.GantiEkor(0)
# print(sapi.ekor)

class Node:
    def __init__(self, data):
        self.data = data
        self.next = None

class LinkedList:
    def __init__(self):
        self.head = None
    def display(self):
        current = self.head
        while current != None:
            print(current.data, end=" -> ")
            current = current.next    
    def searching(self, key):
        current = self.head
        while current is not None:
            if current.data == key:
                return True
            current = current.next
        return False        
    def add_depan(self, data):
        new_node = Node(data)
        new_node.next = self.head
        self.head = new_node
    def add_belakang(self, data):
        new_node = Node(data)
        current = self.head
        while current.next != None:
            current = current.next
        current.next = new_node

Ll = LinkedList()
Ll.head = Node(10)
Ll.display()
def append(self, data):
        new_node = Node(data)
        if not self.head:
            self.head = new_node
            return
        last = self.head
        while last.next:
            last = last.next
        last.next = new_node
print("Linked List after appending 10:")
Ll.display()
Ll.append(20)
print("\nLinked List after appending 20:")
Ll.display()
Ll.append(30)
print("\nLinked List after appending 30:")
Ll.display()
Ll.append(40)
print("\nLinked List after appending 40:")
Ll.display()
Ll.append(50)
print("\nLinked List after appending 50:")