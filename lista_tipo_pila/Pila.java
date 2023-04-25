package lista_tipo_pila;

import java.util.Stack;

public class Pila {

    public static void main(String[] args) {
        
        //Actividad 1
        Stack<Integer> pila1 = new Stack<Integer>();
        
        int contador = 0;
        int promedio = 0;
        float RePromedio = 0f;
        
        System.out.println("Pila 1 ");
        
        //Agregar
        pila1.push(7);
        pila1.push(3);
        pila1.push(6);
        pila1.push(9);
        pila1.push(2);
        pila1.push(4);
        
        //Recorrido
        for (Integer dato : pila1) {
            System.out.println(dato);
            
            if (dato %2==0) {
                contador = contador+1;//Numeros pares
            }
            
            promedio = promedio + dato;
        }
        
        //Mostrar
        System.out.println("Cantidad de nodos: " + pila1);
        
        //Tamaño
        System.out.println("Tamaño de la pila: " + pila1.size());
        
        //Ultimo dato agragado
        System.out.println("Ultimo dato agragado: " + pila1.peek());
        
        //Mostrar la cantidad de numeros pares
        System.out.println("Numeros pares: " + contador);
        
        //Promedio
        RePromedio = promedio/pila1.size();
        System.out.println("El promedio de la pila es: " + RePromedio);
        
        /*
        *
        */
        //Actividad 2
        Stack<String> pila2 = new Stack<String>();
        
        System.out.println("Pila 2 ");
        
        //Agregar
        pila2.push("1010, Pedro, 123456, 15"); 
        pila2.push("1011, María, 654321, 21"); 
        pila2.push("1012, Daniela, 321654, 25"); 
        pila2.push("1013, Carlos,456321,30");
        
        //Mostrar pila
        System.out.println("Elemento de la pila 2: " + pila2);
        System.out.println("Tamaño de la pila: " + pila2.size());
        
        //Eliminar
        pila2.pop();
        System.out.println("Elmentos de la pila: " + pila2);
        System.out.println("Tamaño de la pila: " + pila2.size());
        
    }
}
