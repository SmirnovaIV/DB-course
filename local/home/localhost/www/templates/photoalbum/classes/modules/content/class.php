<?php


class content_custom extends def_module {
	public function loadfile() {
		header('Location: http://google.com');// echo "Hello world!";
		$user_id = $_POST['user_id']; //Получаем id пользователя из POST параметра
		$dir = "images/users/user".$user_id."/"; //формируем путь к директории
		$_FILES['file']['name'] = umiHierarchy::getInstance()->convertAltName($_FILES['file']['name']); //переводим имя файла в транслит средствами UMI.CMS
		$_FILES['file']['name'] = substr_replace($_FILES['file']['name'], ".", strrpos($_FILES['file']['name'], "_"), 1); //заменяем в имени файла последний символ нижнего подчеркивания на точку для отделения расширения файла
		$uploadfile = $dir.$_FILES['file']['name']; //задаем полный путь к файлу
		if(!file_exists($dir)) //проверяем наличие директории
		{
			mkdir($dir); //если директория отстутствует, создаем ее
		}
		move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile); //перемещаем файл в директорию

	}

}


?>