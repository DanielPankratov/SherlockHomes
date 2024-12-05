# SherlockHomes


<br>

![shl](https://github.com/user-attachments/assets/d521d8cd-e4a0-43f3-8403-54decc780638)

<br>

Este projeto foi desenvolvido como parte do projeto final do Curso Profissional Técnico de Gestão e
Programação de Sistemas Informáticos(CPTGPSI).

O projeto consiste numa plataforma de pesquisa de imóveis, que agrega num único sítio, imóveis disponibilizados por outros sites. Permite ao utilizador efetuar pesquisas de imóveis utilizando filtros por tipo de imóvel, localização, tipologia e tipo de negócio (comprar ou alugar), adicionar imóveis à sua lista de favoritos e consultar todas as suas características. 
Os preços dos imóveis são catalogados através de um sistema de cores, verde para os preços 10% abaixo da média e vermelho para os preços 10% acima da média.
Os imóveis são inseridos na base de dados através de web scrapping, usando scripts desenvolvidos em python, ou através de um formulário de inserção de imóveis, disponível na área de administração. Apenas os administradores podem gerir os imóveis existentes na plataforma. Aos utilizadores é dada a possibilidade de poderem gerir a sua lista de favoritos.
Todos os imóveis importados através de web scrapping contêm uma hiperligação para o site de origem desse imóvel. Sempre que os scripts são executados, se o imóvel não existir na base de dados será adicionado, se existir e o preço do imóvel tiver sofrido alguma alteração, o respetivo preço será atualizado. As informações recolhidas através dos diversos sites são efetuadas através de diferentes scripts.

<br>
<br>
<br>

### Apresentação do Projeto

https://github.com/user-attachments/assets/ffbc6e07-1da1-450e-9572-8058311179eb

(Ver no <a href="https://www.youtube.com/watch?v=sgW0GfXk3tA" name="unique-anchor-name">Youtube</a>.)

<br>
<br>
<br>

## Tecnologias utilizadas

<br>

<div style="display: flex; justify-content: center; align-items: center;">
    <img alt="Python" src="https://images.ctfassets.net/em6l9zw4tzag/oVfiswjNH7DuCb7qGEBPK/b391db3a1d0d3290b96ce7f6aacb32b0/python.png" width="100">
    <img alt="Laravel" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1200px-Laravel.svg.png" width="100">
    <img alt="Laravel" src="https://datascientest.com/en/files/2024/01/beautiful-soup.png" width="180">
    <img alt="Laravel" src="https://requests.readthedocs.io/en/latest/_static/requests-sidebar.png" width="100">
</div>

<br>

* Python - Para desenvolver os bots que fazem a recolha de dados na internet  
* Laravel - Framework PHP para poder manipular os dados do meu website
* BeautifullSoup - Biblioteca Python para manipular o HTML e recolher dados
* Requests - Biblioteca Python para fazer requests

<br>

Ver [Relatório do Projeto](RelatorioPAP.pdf).

