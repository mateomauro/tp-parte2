formas de interactuar con la api:

LLAMADOS CON EL VERBO GET:

    obtener 1 vehiculo:
        "trabajo%20final%20parte%202/api/vehiculos/ID"

    obtener vehiculos:
        "trabajo%20final%20parte%202/api/vehiculos"

    obtener vehiculos filtrados:   
        "trabajo%20final%20parte%202/api/vehiculos?filtro=columna&valorDeFiltro=valorColumna"

    obtener vehiculos ordenados(asc/desc) por columna: 
        "trabajo%20final%20parte%202/api/vehiculos?campo=nombre_de_columna&orden=asc_o_desc"

    obtener vehiculos ordenados(asc/desc) por id: 
        "trabajo%20final%20parte%202/api/vehiculos?orden=asc_o_desc"

    obtener vehiculos ordenados ascendentemente por columna: 
        "trabajo%20final%20parte%202/api/vehiculos?campo=nombre_de_columna"

    obtener vehiculos paginadas a partir de cierto elemento: 
        "trabajo%20final%20parte%202/api/vehiculos?limite=elementos_por_pagina&offset=a_partir_de_que_elemento"

    obtener vehiculos paginadas (offset x defecto): 
        "trabajo%20final%20parte%202/api/vehiculos?limite=elementos_por_pagina"

    obtener vehiculos a partir de cierto elemento  
        "trabajo%20final%20parte%202/api/vehiculos?offset=a_partir_de_que_elemento"

LLAMADOS CON EL VERBO DELETE:

    eliminar 1 vehiculo:
        "trabajo%20final%20parte%202/api/vehiculos/:ID"

LLAMADOS CON EL VERBO PUT:

    editar 1 vehiculo:
        "trabajo%20final%20parte%202/api/vehiculos/:ID"

LLAMADOS CON EL VERBO POST:

    insertar 1 vehiculo:
        "trabajo%20final%20parte%202/api/vehiculos"