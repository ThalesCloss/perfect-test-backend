# Executando o Projeto
 # Via Docker
 No diretório raiz do projeto, onde se encontra o arquivo docker-compose.yml executar os seguintes comandos.
 
 Para subir os containers:
 `docker-compose up -d`
 
 Para instalar as dependências do composer
 `docker exec -it php-fpm_pay composer install`
 
 Para executar as migrations
 `docker exec -it php-fpm_pay php artisan migrate`

 Em caso de problemas com as permissões da pasta storage
 `docker exec -it php-fpm_pay chmod 775 storage`

 Executando os passos a aplicação estará disponível no endereço http://localhost:8080.
 Um administrador do mysql estará disponível no endereço http://localhost:8081.

 *Certifique-se de que as portas informadas estão disponíveis no computador

# Execução local

Para execução local deve ser configurado o servidor http de sua preferência ou a execução do servidor interno do PHP.

A conexão do banco de dados deve ser ajustada no arquivo .env, de acordo com as configurações existentes na máquina.

Para instalar as dependências do composer
 `composer install`
 
 Para executar as migrations
 `php artisan migrate`







# Arquitetura da aplicação
A aplicação desenvolvida em PHP com Laravel 7.x tem foco na construção do backend, portanto é a parte de maior atenção.
Segui uma proposta baseada na clean Architectur
 e, mantendo a separação das regras de negócio e os detalhes de implementação e framework.

Estrutura da arquitetura:
- Entities: O núcleo do sistema, embora com poucas regras de negócio verificadas nas entidades, mantem as responsabilidades 
- ValueObjects: São os objetos de valor utilizados para compor as entidades e promover maior riqueza na implementação
- UseCases: Onde são implementadas as ações esperadas que o sistema execute.
  - Contracts: Interfaces para inversão de dependências, no caso os UseCases utilizam interfaces de repositórios, sem a preocupação de como o dado deve ser persistido.
- Repositories: São as implementações para os contratos definidos nos UseCases, foi realizada uma implementação parcial em memória e uma implementação completa baseada no ORM Eloquent do Laravel.

Com a organização da arquitetura espera-se diminuir o acoplamento a componentes que não fazem parte do negócio, possibilitando atualizações de versões de framework ou troca de alguma tecnologia de suporte sem maiores problemas.

Alguma funcionalidades do Laravel foram utilizadas como suporte ao negócio, apenas para aproveitar as facilidades da ferramenta. Como a validação de requests no framework, não excluindo as validações no domínio da aplicação.

