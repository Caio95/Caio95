'use strict';

angular.module('moduloDados',[])
    .controller('dadosController', function($rootScope, $scope, $http, $location, $localStorage){
        $rootScope.pageTitle = 'AABB Esportivo | Meus Dados';

        if($localStorage.usuario){
            $rootScope.usuario = $localStorage.usuario;
            $rootScope.name = $localStorage.name;

            $http.get('http://localhost/aabb/api/usuario/find.php?id='+ $localStorage.usuario)
            .then(function(result){                
                $scope.nome = result.data.nomeUser;
                $scope.endereco = result.data.enderecoUser;
                $scope.nivel = result.data.nivelUser;
                $scope.telefone = result.data.telefoneUser;
                $scope.email = result.data.emailUser;
                $scope.senha = result.data.senhaUser;
            })

            $scope.alterar = function(){
                
                $http.post('http://localhost/aabb/api/usuario/update.php',{
                    'nome' : $scope.nome,
                    'endereco' : $scope.endereco,
                    'senha' : $scope.senha,
                    'telefone' : $scope.telefone,
                    'idUser' : $localStorage.usuario         
                }).then(function(result){
                    alert('alterado com sucesso!');
                    console.log(result);
                    
                })
            }

            $scope.sair = function(){
                $rootScope.usuario =false;
                $location.path('/');
                delete $localStorage.usuario;
            }

        } else{
            $location.path('/');
        }
    })