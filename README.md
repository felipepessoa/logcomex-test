## Para obter a chave de API do Gemini, siga os passos abaixo:
1. Acesse o site do Ai Studio: https://aistudio.google.com/api-keys
2. Faça login na sua conta ou crie uma nova conta.
3. Navegue até a seção de API e gere uma nova chave de API.
4. Copie a chave de API gerada e cole no arquivo `.env` na raiz do backend, substituindo o valor da variável `GEMINI_API_KEY`.

## Para executar o projeto, siga os passos abaixo:
1. Acesse a raiz do projeto
2. Execute o comando `docker compose up` para iniciar os serviços. Espere para que a imagens sejam criadas e as dependencias sejam instaladas.
3. Para acessar a interface, abra o navegador e insira `https://logcomex.localhost` o projeto estará disponível para uso. Caso apareça que o certificado não é confiável, basta avançar para continuar, pois o certificado é autoassinado.

## Arquitetura do projeto
O projeto é dividido em backend e frontend, sendo o backend rodando em PHP 8.5 com Laravel 13 e o frontend em React 19 com Vite <br />
O backend utiliza o pacote [spatie/laravel-data]([https://github.com/spatie/laravel-data](https://spatie.be/docs/laravel-data/v4/introduction)) para facilitar a manipulação e validação de dados. <br />
Tambem é utilizado o pacote [spatie/typescript-transformer](https://github.com/spatie/laravel-typescript-transformer) para gerar tipos TypeScript a partir dos dados do Laravel. <br />
O projeto de foi desenvolvido de uma forma simples, utilizando Services para fazer a comunicação com o Gemini e Jobs para processar os arquivos de upload, evitando que o processo de importação fique travado. <br />
Existem duas rotas principais no backend, uma para importar os arquivos e outra para listar os arquivos importados. A rota de importação recebe o arquivo enviado pelo usuário, envia para o Gemini e retorna o resultado do processamento. A rota de listagem retorna os dados importados, com a possibilidade de filtros. <br />
No frontend, existe apenas uma tela exibindo o que foi importado e um botão para importar novos arquivos. A tela de listagem exibe os dados importados em uma tabela, com a possibilidade de filtros. <br />
Foram criados componentes basicos para manter a facilidade de manutenção e reutilização do código. <br />

## O que gostária de ter implementado no projeto
  - Testes unitários e de integração.
  - Progresso do processo de importação e extração dos do upload
    - Criar uma tabela de controle de upload, gravando o id, caminho do arquivo, status do upload e data de criação.
    - Incluir no Controller a criação do registro no banco de dados no método de importar. Também criar uma entrada no cache para facilitar a consulta do status do upload.
    - Incluir no Job o progresso de upload, gravando o status no banco de dados e atualizando o cache.
    - Incluir no Controller um método para consultar o status do upload, retornando o progresso do upload e o status do processo.
    - Incluir no Frontend a exibição do progresso do upload, utilizando o método de consulta do status do upload para atualizar a interface em tempo real.
  - Paginação
    - Incluir no metodo de listagem a paginação e adequar o frontend para exibir a paginação.