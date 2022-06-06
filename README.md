## Technical Challenge Spot (Backend Engineer)

Una aplicación crítica de Spot necesita obtener el precio agregado (promedio, mínimo y máximo) por
m2 un código postal de la alcaldía Gustavo A. Madero utilizando datos del Gobierno de la Ciudad de
México, los cuales puedes descargar aquí: https://sig.cdmx.gob.mx/datos/#d_datos_cat, desarrolla
una API que podamos consultar para obtener estos resultados.

La consulta al API tendría que ser de la siguiente manera:

GET /price-m2/zip-codes/{zip_code}/aggregate/{max|min|avg}?construction_type={1-7}
Donde construction_type es “uso_construccion” en la base de datos y los valores pueden ser:

1) Áreas verdes
2) Centro de barrio
3) Equipamiento
4) Habitacional
5) Habitacional y comercial
6) Industrial
7) Sin Zonificación

#Se deben de brindar dos resultados:
   ● price_unit: Uno basado en la “superficie_terreno” / “valor_suelo” - “subsidio”.

   ● price_unit_construction: Otro basado en la “superficie_construccion” / “valor_suelo” -
   “subsidio”. 
#Ejemplos de respuestas de acuerdo a la operación realizada:
   PROMEDIO:
   {
        "status": true,
        "payload": {
            "type": "avg",
            "price_unit": 1420,
            "price_unit_construction": 3120,
            "elements": 100
        }
   }

   MÁXIMO
   {
   "status": true,
   "payload": {
   "type": "max",
   "price_unit": 4520,
   "price_unit_construction": 5120,
   "elements": 80
   }
   }

   MÍNIMO
   {
   "status": true,
   "payload": {
   "type": "min",
   "price_unit": 1250,
   "price_unit_construction": 2120,
   "elements": 60
   }
   }

   #Donde
   ● type: tipo de operación agregada como promedio, mínimo y máximo.

   ● price_unit: es el precio unitario.

   ● price_unit_construction: es el precio unitario contemplando terreno de construcción.

   ● elements: valores sobre los que se realizó la operación.

   #Resultados esperados
   ● Puedes entregar en tu ambiente de desarrollo. Pero el API debe de funcionar y tu proyecto
   deberá contener todas las instrucciones para reproducirlo (migraciones, seeders, endpoints,
   etc).

   ● Bonus: Entregar también en un ambiente productivo.

   #Requerimientos
   ● Tienes dos días para completar este tech challenge.

   ● Tech Stack: Laravel y SQL. Puedes realizarlo en otros stacks, pero deberás presentar porqué
   lo desarrollaste así en la entrevista.

   #Consejos
   ● Menos es más.

   ● Pensar fuera de la caja.

   ● Las migraciones y los seeders son herramientas muy útiles del proceso de desarrollo.

   ● ¿Pruebas unitarias? ¿Incluiste alguna?

   ● ¿Por qué deberíamos adoptar tu solución o qué mejorarías?

   ● ¿Este sería un código que pondrías en producción?

   #Notas
   ● La explicación de los campos de la base de datos se encuentra en la página donde lo
   descargaste.

   ● Los entregables son: código en tu repositorio de Github y URL de tu entorno de pruebas.

   ● ¿Dudas? Envíame correo a dante@spot2.mx
# ChallengeSpot2
