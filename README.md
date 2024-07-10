# ✨ Api de registro de dados

## Introdução
Bem-vindo à documentação da API do nosso projeto, que foi desenvolvida utilizando o [framework Hyperf](https://hyperf.wiki/3.1/#/en/). Esta API tem o propósito de receber requisições da plataforma do [Mapa Cultural do Ceará](https://mapacultural.secult.ce.gov.br/) sempre que um usuário realizar alterações em determinadas entidades como as oportunidades e as inscrições, tais como criar, alterar ou excluir dados.


# 🎯 Funcionalidades da API

Nossa API foi projetada para suportar as seguintes operações:

 - 💾 **Salvar Dados**: Permitir a inserção de dados vindo de uma requisição plataforma do Mapa Cultural do Ceará, após uma usuário realizar uma ação estando logado
 - 📃 **Retornar Dados**: Retornar dados da api de uma determinada entidade da plataforma do Mapa Cultural do Ceará.

## 🖥️ Tecnologias Utilizadas

 1. **Hyperf Framework**: Um framework PHP de alta performance, ideal para aplicações que requerem alta disponibilidade e escalabilidade.
 2. **Docker**: Docker para subir aplicação e seus serviços como banco de dados Mysql
 3. **Swagger**:  [Swagger](http://swagger.io/) é uma ferramenta de documentação de API que permite a criação de uma interface interativa, facilitando a compreensão e a utilização dos endpoints disponíveis.

## 🎯 Objetivo

Nosso principal objetivo é proporcionar uma integração robusta e eficiente, permitindo que a plataforma do Mapa Cultural do Ceará e essa API trabalhem em conjunto de forma harmoniosa. Com isso, pretendemos melhorar a gestão e o compartilhamento de informações das ações dos usuários, para trazer um contexto claro das ações dos usuários os administradores da plataforma.


## Instalação
- Clonar
- docker compose up
- docker exec hyperf-skeleton php bin/hyperf.php migrate
