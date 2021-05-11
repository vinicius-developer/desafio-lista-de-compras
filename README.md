# Desafio - lista de compras

### Estudos 01/05

# O teste

A grande escola de ensino fundamental Hogwarts faz o controle das
suas compras de alimentos manualmente. A lista de compras
atualmente é escrita pelo cozinheiro Dobby (manualmente) em um
caderno. Após as compras, Dobby reune todo o conteúdo do mês (os
papeis) e os envia para a direção da escola analisar os gastos mensais
e anuais.

Com o passar do tempo esse método ficou cansativo e caro, tendo em
vista que é muito difícil você controlar uma quantidade tão grande de
informações em um caderno e ainda por cima lembrar de realizar o
envio manualmente para os diretores da escola.

Decidindo mudar esse fluxo e o trabalho manual desnecessário, a
diretora da escola fez a contratação de um **programador PHP para
a automatização desse processo**, mas em pequenos passos para
testar a qualidade da mudança.

## Passo 1 - Gerar Arquivo CSV
**O programador terá um arquivo com as listas de alimentos
criadas (lista-de-compras.php) com todos os dados
preenchidos que retorna uma estrutura de Array.**

Baseado nessa lista, ele criará outro script .php que **faz a leitura do
arquivo lista-de-compras.php, onde o resultado final será a
geração de um arquivo .csv** salvo na pasta com o nome **compras-do-ano.csv**.

O resultado final desse arquivo deve seguir a mesma estrututa do
exemplo abaixo (a tabela), levando em consideração os dados
contidos na nossa lista de alimentos (lista-de-compras.php):

|Mês|Categoria|Produto|Quantidade|
|-|-|-|-|
|Janeiro|Alimentos|Pão de forma|10|
|Janeiro|Higiene Pessoal|Creme dental|50|
|Janeiro|Higiene Pessoal|Escova de dente |40|
|Janeiro|Limpeza|Desinfetante|5|
|Fevereiro|Higiene Pessoal|Creme dental|50|
|Fevereiro|Higiene Pessoal|Sabonete líquido|45|
|Março|Alimentos|Ovos|300|

Para a geração desse csv o programador tem que seguir algumas
regras, que são:

* O arquivo criado tem que ser ordenador de acordo com a ordem
natural dos meses:
    * Janeiro
    * Fevereiro
    * Março
    * (etc)

* Respeitando a ordenação dos meses, o programador tem que
salvar os produtos no arquivo ordenados pelas categorias:
    1. Alimentos
    2. Higiene Pessoal
    3. Limpeza

* Respeitando as duas ordenações anteriores, o programador tem
que salvar os produtos no arquivo ordenados da maior quantidade para a menor.

* O(s) mes(es) com conteúdo vazio não devem estar presentes no
csv.

Exemplo de ordenação:

|Mês|Categoria|Produto|Quantidade|
|-|-|-|-|
|Janeiro|Alimentos|Pão de forma|10|
|Janeiro|Alimentos|Biscoito |5|
|Janeiro|Higiene|Pessoal Creme dental|50|
|Janeiro|Higiene|Pessoal Escova de dente|40|
|Janeiro|Limpeza|Desinfetante|5|
|Janeiro|Limpeza|Detergente|4|
|Janeiro|Limpeza|Sabão em pó|3|

* Algumas palavras no Array estão incorretas, antes de salvar no
arquivo é necessário substitui-las:

|Trocar de (palavra errada)|Por (palavra correta)|
|-|-|
|Papel Hignico|Papel Higiênico|
|Brocolis|Brócolis|
|Chocolate ao leit|Chocolate ao leite|
|Sabao em po|Sabão em pó|

## Passo 2 - Salvar os dados no BD
Feito o primeiro teste, crie um outro script que consultará os
dados do arquivo lista-de-compras.php e salvará esses
mesmos dados no MySQL.

Crie uma estrutura relacional (nome do banco de dados, nome da(s)
tabela(s), etc) da melhor forma que lhe convém.

Antes de salvar os dados no MySQL é necessário usar a mesma regra
de substituição de palavras do primeiro teste.

## Anotações do Desenvolvedor

### Antes de iniciar o projeto

* Configure as variáveis de ambiente no arquivo `main.php` com os dados que você
  utiliza no seu banco de dados:
  
```
$_ENV['DB_HOST'] = '';
$_ENV['DB_PORT'] = '3306';
$_ENV['DB_DATABASE'] = '';
$_ENV['DB_USERNAME'] = '';
$_ENV['DB_PASSWORD'] = '';
```

### Para iniciar o projeto

* Para iniciar o projeto vá até à pasta onde ele está e rode o seguinte 
  comando:
  
```
php main.php nome_do_arquivo
```

### Saídas de dados

* Todos os arquivos csv serão criados na pasta `arquivos`.


* Para poder visualizar melhor os dados no mysql utilize a seguinte 
query:
  
```
select
    m.name,
    c.name,
    li.name_item,
    li.quantity
from list_items as li
join categories c
    on c.id_category = li.id_category
join months m
    on m.id_month = li.id_mouth;
```

