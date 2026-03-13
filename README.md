# AgendAI

Projeto final da disciplina de Desenvolvimento Web 1.

O **AgendAí** é um sistema web desenvolvido em PHP com banco de dados MySQL, com foco em cadastro de usuários, autenticação, controle de acesso por perfil e gerenciamento de serviços. O sistema foi pensado para simular uma plataforma simples de agendamentos, com área pública e área privada, seguindo os requisitos propostos no trabalho.

---

## Objetivo do Projeto

O objetivo deste projeto foi desenvolver um sistema/website com:

- área pública acessível sem login;
- área privada acessível apenas após autenticação;
- diferentes perfis de usuário com permissões específicas;
- operações de cadastro, edição, exclusão e listagem;
- integração com banco de dados;
- organização do código em camadas e arquivos separados;
- implementação de uma chamada assíncrona AJAX para pontuação extra.

---

## Área Pública

A área pública pode ser acessada sem a necessidade de login e possui as seguintes páginas:

- **Home**: apresentação do sistema e seus objetivos;
- **Quem Somos**: informações institucionais;
- **Casos de Uso**: exemplos fictícios de utilização do sistema;
- **Contato**: informações de contato;
- **Login**: autenticação de usuários;
- **Registro**: cadastro de novos usuários.

---

## Área Privada

A área privada do sistema é acessível apenas para usuários autenticados e possui funcionalidades diferentes de acordo com o perfil do usuário.

---

## Perfis de Usuário e Funcionalidades

### Usuário Cliente

O usuário com perfil **Cliente** possui as seguintes funcionalidades:

- acessar sua conta no sistema;
- visualizar e editar o próprio perfil;
- excluir a própria conta;
- visualizar os serviços cadastrados por usuários dos tipos **Prestador** e **Admin**;
- não pode cadastrar, editar ou excluir serviços.

---

### Usuário Prestador

O usuário com perfil **Prestador** possui as seguintes funcionalidades:

- acessar sua conta no sistema;
- visualizar e editar o próprio perfil;
- excluir a própria conta;
- cadastrar novos serviços;
- editar serviços cadastrados por ele mesmo;
- excluir serviços cadastrados por ele mesmo;
- visualizar apenas os seus próprios serviços.

---

### Usuário Admin

O usuário com perfil **Admin** possui as seguintes funcionalidades:

- possui as mesmas permissões do usuário **Prestador**;
- pode cadastrar, editar, excluir e visualizar os próprios serviços;
- pode acessar sua conta, editar perfil e excluir a própria conta;
- possui uma funcionalidade exclusiva de admin;
- pode visualizar todos os usuários cadastrados no sistema;
- pode excluir contas de usuários, quando necessário;
- não pode excluir contas de outros usuários do tipo **Admin**.

---

## Chamada Assíncrona AJAX

Como funcionalidade extra, foi implementada uma **chamada assíncrona AJAX usando `fetch()` em JS**.

### O que foi feito:
Foi criada uma exclusão assíncrona de serviços, onde:

- a requisição é enviada sem recarregar a página;
- o backend em PHP processa a ação;
- a resposta é retornada em **JSON**;
- o serviço é removido da tabela;
- a página continua aberta, sem necessidade de reload.

---

## Funcionalidades Implementadas

O sistema contempla as seguintes funcionalidades principais:

- cadastro de usuário;
- login com autenticação;
- logout do sistema;
- controle de acesso por perfil;
- edição de perfil;
- exclusão da própria conta;
- cadastro de serviços;
- edição de serviços;
- exclusão de serviços;
- listagem de serviços;
- listagem de usuários para administrador;
- exclusão de usuários por administrador;
- chamada assíncrona AJAX com `fetch()` para exclusão de serviços.

---

## Tecnologias Utilizadas

Este projeto foi desenvolvido utilizando:

- **PHP**
- **MySQL**
- **PDO**
- **HTML5**
- **CSS3**
- **Bootstrap**
- **JavaScript**
- **AJAX com fetch()**
- **XAMPP** para ambiente local
- **InfinityFree** para hospedagem
- **Git e GitHub** para versionamento
