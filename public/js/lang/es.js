/*
* Script de traducciones del sitio (js)
* Luis Castañeda
* v 0.1
*
*/

var lang = {
	/* script */
	'language': "es",
	'accept': "Aceptar",
	'cancel': "Cancelar",
	'exit': "Salir",
	'delete': "Eliminar",
	'error': "Error",
	'saving': "Guardando",
	'loading': "Cargando",
	'deleting': "Eliminando",
	'activate': "Activar",
	'deactivate': "Desactivar",
	'active': "Activo",
	'inactive': "Inactivo",
	'check': "Marcar",
	'uncheck': "Desmarcar",
	'q_exit': "¿Quieres cerrar sesión?",
	'q_status': "¿%var este registro?",
	'q_check': "¿%var este registro?",
	'q_delete': "¿Quieres eliminar este registro?",
	'q_mul_delete': 'Se eliminarán %var registro(s), ¿Estás seguro?',
	's_delete': "Registro eliminado exitosamente",
	's_status': "Se ha modificado el estatus",
	's_check': "Item changed successfully",
	'wrong': "Ha ocurrido un error",

	/* validForm */
	'verify_fields': "Verifique los siguientes campos:",
	'empty_field': "Campo vacio",
	'invalid_email': "Correo inválido",
	'integer_decimal': "Valor entero o decimal requerido",
	'char': 'caracteres',
	'min_char': "Mínimo de %var caracteres",
	'max_char': "Máximo de %var caracteres",
	'equal_char': "Total de $var caracteres",
	'val_min': "Valor mínimo posible %var",
	'val_max': "Valor Máximo posible %var",
	'allowed_ext': "Extensiones permitidas %var",
	'max_size': 'El archivo debe ser menos de %var mb',
	'error_save': "Error al guardar",
	'system_aid': "Contacte con el administrador de sistema para obtener ayuda"
}

function passValToString(str){
	var args = [].slice.call(arguments, 1),
		i = 0;

	return str.replace(/%var/g, function() {
		return args[i++];
	});
}