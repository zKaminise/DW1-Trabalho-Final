# AgendAI

O **AgendAI** é um sistema web simples desenvolvido em **PHP e MySQL** que permite o cadastro de usuários e o gerenciamento de serviços cadastrados por prestadores.

O objetivo do sistema é simular uma plataforma onde prestadores podem cadastrar serviços e clientes podem visualizar esses serviços disponíveis.

Este projeto foi desenvolvido como **trabalho final da disciplina de Desenvolvimento Web 1**.

---

# Tecnologias utilizadas

Para desenvolver o sistema foram utilizadas as seguintes tecnologias:

- PHP
- MySQL
- HTML
- CSS
- Bootstrap
- PDO para conexão com o banco de dados
- XAMPP para ambiente de desenvolvimento

---

# Funcionalidades do sistema

O sistema possui algumas funcionalidades básicas de autenticação e gerenciamento de dados.

## Cadastro de usuários

Um novo usuário pode criar uma conta informando:

- Email
- Senha
- Tipo de usuário

Os tipos disponíveis são:

- Cliente
- Prestador
- **Temos o Usuario ADMIN, apenas 1 conta fixa**

Após o cadastro, o usuário já pode realizar login no sistema.

---

## Login

O sistema possui uma tela de login onde o usuário informa seu email e senha.

A senha é armazenada no banco utilizando **hash de segurança** com `password_hash()`.

Após o login, o sistema identifica o perfil do usuário e libera as funcionalidades permitidas para aquele tipo de conta.

---

# Perfis de usuário

O sistema possui três perfis diferentes.

## Cliente

O cliente pode:

- acessar o sistema
- visualizar os serviços cadastrados pelos prestadores
- visualizar qual usuário cadastrou cada serviço
- acessar e atualizar seu perfil

O cliente **não pode criar, editar ou excluir serviços**.

---

## Prestador

O prestador pode:

- cadastrar novos serviços
- editar seus próprios serviços
- excluir serviços que ele cadastrou
- visualizar os serviços cadastrados

Os serviços cadastrados por um prestador ficam disponíveis para visualização dos clientes.

---

## Administrador

O administrador possui as mesmas permissões do prestador, além de ter acesso à área de gerenciamento de usuários.

Ele pode visualizar os usuários cadastrados no sistema.

---
