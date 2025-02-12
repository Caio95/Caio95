<?php
require_once('Database.php');

Class Usuario {
    public static function add($nome, $email, $senha, $telefone, $permissao){
        $pdo = Database::connection();
        $sql = 'INSERT INTO usuario(nomeUser, emailUser, senhaUser, telefoneUser, permissao) VALUES (?, ?, ?, ?, ?)';
        $r = false;
        try{
            $query = $pdo->prepare($sql);
            $r = $query->execute(array($nome, $email, $senha, $telefone, $permissao));
            if($query->rowCount() > 0){
                return $pdo->lastInsertId();
            }
        }
        catch (Exception $ex){
            throw new Exception("Erro ao cadastrar usuario", 1);
        }
    }

    public static function delete($id){
        $pdo = Database::connection();
        $sql = 'DELETE FROM usuario WHERE idUser = ?';
        $query = $pdo->prepare($sql);
        $query->execute(array($id));
        return $query->rowCount() > 0;
    }

    public static function validEmail(){
        $pdo = Database::connection();
        $sql = 'SELECT emailUser FROM usuario WHERE idUser > 1';
        $query = $pdo->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function all(){
        $pdo = Database::connection();
        $sql = 'SELECT * FROM usuario WHERE idUser > 1';
        $query = $pdo->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $pdo = Database::connection();
        $sql = 'SELECT * FROM usuario WHERE idUser = ?';
        $query = $pdo->prepare($sql);
        $query->execute(array($id));
        $user = $query->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public static function validate($email, $senha){
        $pdo = Database::connection();
        $sql = 'SELECT * FROM usuario WHERE emailUser = ? AND senhaUser = ?';
        $query = $pdo->prepare($sql);
        $query->execute(array($email, $senha));
        $usuario = $query->fetch(PDO::FETCH_ASSOC);
        return $usuario;
    }
    
    public static function update($nome, $endereco, $senha, $telefone, $idUser){
        $pdo = Database::connection();
        $sql = 'UPDATE usuario SET nomeUser=?, enderecoUser=?, senhaUser=?, telefoneUser=? WHERE idUser=?';
        $query = $pdo->prepare($sql);
        $query->execute(array($nome, $endereco, $senha, $telefone, $idUser));
        $usuario = $query->fetch(PDO::FETCH_ASSOC);
        return $usuario;
    }

    public static function update_nivel($nivel, $idUser){
        $pdo = Database::connection();
        $sql = 'UPDATE usuario SET nivelUser=? WHERE idUser=?';
        $query = $pdo->prepare($sql);
        $query->execute(array($nivel, $idUser));
        $usuario = $query->fetch(PDO::FETCH_ASSOC);
        return $usuario;
    }

    public static function salvar_foto($foto, $idUser){
        $pdo = Database::connection();
        $sql = 'UPDATE usuario SET foto_perfil=? WHERE idUser=?';
        $query = $pdo->prepare($sql);
        $query->execute(array($foto, $idUser));
        $usuario = $query->fetch(PDO::FETCH_ASSOC);
        return $usuario;
    }

    public static function desativar_usuario($desativa, $idUser){
        $pdo = Database::connection();
        $sql = 'UPDATE usuario SET desativaUser=? WHERE idUser=?';
        $query = $pdo->prepare($sql);
        $query->execute(array($desativa, $idUser));
        $usuario = $query->fetch(PDO::FETCH_ASSOC);
        return $usuario;
    }

}