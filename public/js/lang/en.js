/*
* Script de traducciones del sitio (js)
* Luis Castañeda
* v 0.1
*
*/

var lang = {
	/* script.js */
	'language': "en",
	'accept': "Accept",
	'cancel': "Cancel",
	'exit': "Exit",
	'delete': "Delete",
	'error': "Error",
	'saving': "Saving",
	'loading': "Loading",
	'deleting': "Deleting",
	'activate': "Activate",
	'deactivate': "Deactivate",
	'active': "Active",
	'inactive': "Inactive",
	'check': "Check",
	'uncheck': "Uncheck",
	'q_exit': "Do you want to log out?",
	'q_status': "%var this item?",
	'q_check': "¿%var this item?",
	'q_delete': "Do you want to delete this item?",
	'q_mul_delete': '%var item(s) will be deleted, are you sure?',
	's_delete': "Item deleted successfully",
	's_status': "Status of the item changed successfully",
	's_check': "Item changed successfully",
	'wrong': "An error has occured",

	/* validForm.js */
	'verify_fields': "Verify the next fields",
	'empty_field': "Empty field",
	'invalid_email': "Invalid email",
	'integer_decimal': "Integer or decimal required",
	'char': 'characters',
	'min_char': "Minimum of %var characters",
	'max_char': "Maximum of %var characters",
	'equal_char': "Total of $var caracteres",
	'val_min': "Minimum value possible %var",
	'val_max': "Maximum value possible %var",
	'allowed_ext': "Allowed extensions %var",
	'max_size': 'The file size must be less of %var mb',
	'error_save': "Error on save",
	'system_aid': "Contact the administrator of the system for assistance"
}

function passValToString(str){
	var args = [].slice.call(arguments, 1),
		i = 0;

	return str.replace(/%var/g, function() {
		return args[i++];
	});
}