<?PHP
//conection
$conexao = mysqli_connect('localhost', 'root', '', 'form');
$nome = $conexao->real_escape_string($_POST['user']);
$senha = $conexao->real_escape_string($_POST['senha']);
$email = $conexao->real_escape_string($_POST['email']);
$error = false;
//yii
//sso - single sing on

if (empty($email or $senha or $name) == true) {
	header('Location: ../views/erroemail.html');
} else {
	if (ctype_alpha($nome) === false) {
		$error = true;
		echo "Não foi possível criar sua conta, campo inválido. Tente novamente.\n";
	}
	if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email) and $error == false) {
		$error = true;
		echo "Não foi possível criar sua conta, campo inválido. Tente novamente.\n";
	}
	if (strlen($senha) < 7) {
		// $error = true;
		echo "Não foi possível criar sua conta, campo inválido. Tente novamente.\n";
		exit();
	}

	if ($error == false) {
		//crypto
		$options = [
			'cost' => 11,
		];
		$crSenha = password_hash($senha, PASSWORD_BCRYPT, $options);

		//connection
		$stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email = ?;");
		$stmt->bind_param("s", $email);
		$stmt->execute();

		$result = $stmt->get_result();
		$row = $result->fetch_assoc();

		if (empty($row["email"])) {
			$stmt = $conexao->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?);");
			$stmt->bind_param("sss", $nome, $email, $crSenha);
			$stmt->execute();
			header('Location: ../views/suces.html');
		} else {
			header('Location: ../views/erroemail.html');
		}
		
	}
}
