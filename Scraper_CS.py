from bs4 import BeautifulSoup
from selenium import webdriver

import requests

import urllib.request 

import time
import datetime
from datetime import date, datetime
from datetime import date

import colorama
from colorama import Fore, Back, Style
colorama.init(autoreset=True)

import os
from tomlkit import integer

import mysql.connector 
from itertools import islice

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="sherlockhomes"
)
mycursor = mydb.cursor()

print(Fore.GREEN+str(mydb))

#*Este projecto teve inicio no dia 23/10/2021/
#?=====/ Objecto Imovel /
class Obj_Imovel: 
    def __init__(self, titulo, preco, tipo_preco, localizacao, tipo_imovel, tipologia, n_wc, area_bruta, area_util, website, descricao, url, id, foto): 
        self.titulo = str(titulo) 
        self.preco = integer(preco)
        self.tipo_preco = integer(tipo_preco)
        self.localizacao = integer(localizacao)
        self.tipo_imovel = integer(tipo_imovel)
        self.tipologia = integer(tipologia)
        self.n_wc = integer(n_wc)
        self.area_bruta = integer(area_bruta)
        self.area_util = integer(area_util)
        self.website = website
        self.descricao = descricao
        self.url = url
        self.id = id
        self.foto = foto

Lista_Objectos = []
Lista_Updates=[]
ListaQuerys_CasaSapo = [

    "https://casa.sapo.pt/comprar-apartamentos/t0/",
    "https://casa.sapo.pt/comprar-apartamentos/t1/",
    "https://casa.sapo.pt/comprar-apartamentos/t2/",
    "https://casa.sapo.pt/comprar-apartamentos/t3/",
    "https://casa.sapo.pt/comprar-apartamentos/t4/",
    "https://casa.sapo.pt/comprar-apartamentos/t5/",
    "https://casa.sapo.pt/comprar-apartamentos/t6-ou-superior/",
    
    "https://casa.sapo.pt/alugar-apartamentos/t0/",
    "https://casa.sapo.pt/alugar-apartamentos/t1/",
    "https://casa.sapo.pt/alugar-apartamentos/t2/",
    "https://casa.sapo.pt/alugar-apartamentos/t3/",
    "https://casa.sapo.pt/alugar-apartamentos/t4/",
    "https://casa.sapo.pt/alugar-apartamentos/t5/",
    "https://casa.sapo.pt/alugar-apartamentos/t6-ou-superior/",
    
    "https://casa.sapo.pt/alugar-moradias/t0/",
    "https://casa.sapo.pt/alugar-moradias/t1/",
    "https://casa.sapo.pt/alugar-moradias/t2/",
    "https://casa.sapo.pt/alugar-moradias/t3/",
    "https://casa.sapo.pt/alugar-moradias/t4/",
    "https://casa.sapo.pt/alugar-moradias/t5/",
    "https://casa.sapo.pt/alugar-moradias/t6-ou-superior/",
    
    "https://casa.sapo.pt/comprar-moradias/t0/",
    "https://casa.sapo.pt/comprar-moradias/t1/",
    "https://casa.sapo.pt/comprar-moradias/t2/",
    "https://casa.sapo.pt/comprar-moradias/t3/",
    "https://casa.sapo.pt/comprar-moradias/t4/",
    "https://casa.sapo.pt/comprar-moradias/t5/",
    "https://casa.sapo.pt/comprar-moradias/t6-ou-superior/",

    "https://casa.sapo.pt/alugar-quintas-e-herdades/t0/",
    "https://casa.sapo.pt/alugar-quintas-e-herdades/t1/",
    "https://casa.sapo.pt/alugar-quintas-e-herdades/t2/",
    "https://casa.sapo.pt/alugar-quintas-e-herdades/t3/",
    "https://casa.sapo.pt/alugar-quintas-e-herdades/t4/",
    "https://casa.sapo.pt/alugar-quintas-e-herdades/t5/",
    "https://casa.sapo.pt/alugar-quintas-e-herdades/t6-ou-superior/",

    "https://casa.sapo.pt/comprar-quintas-e-herdades/t0/",
    "https://casa.sapo.pt/comprar-quintas-e-herdades/t1/",
    "https://casa.sapo.pt/comprar-quintas-e-herdades/t2/",
    "https://casa.sapo.pt/comprar-quintas-e-herdades/t3/",
    "https://casa.sapo.pt/comprar-quintas-e-herdades/t4/",
    "https://casa.sapo.pt/comprar-quintas-e-herdades/t5/",
    "https://casa.sapo.pt/comprar-quintas-e-herdades/t6-ou-superior/"
    
    ]
Lista_Links = []
headers = {
    'User-Agent': "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36"}
num_links = int()

#?o seguinte código percorre todas as querys e guarda os links dos imóveis que serão alvos de scraping
for query in ListaQuerys_CasaSapo:   
    try:
        site = requests.get(query, headers=headers)
        soup = BeautifulSoup(site.content, 'html.parser')
        Imoveis_ALL_Cards = soup.find_all('div', class_='property')
        link_for_braker = 0 
        for imoveis in Imoveis_ALL_Cards: #? Este for guarda todos os links das casas da página na lista "Lista_Links"
            if link_for_braker == 5: #!@
                break
            Imovel_Codigo_Link = imoveis.find('a')
            link = Imovel_Codigo_Link.get('href')
            if "comprar" in link and "alugar" in link: #* Está a funcionar
                print(Fore.RED+"IGNORED LINK")
            else:
                if link[0] == "/":
                    newlink = "https://casa.sapo.pt/" + link
                    Lista_Links.append(newlink)
                    num_links += 1
                    # print(Fore.CYAN+"\n" + newlink)
                else:
                    Lista_Links.append(link)
                    num_links += 1
                    # print(Fore.CYAN+"\n" + link)
                link_for_braker +=1 #! depois para braque no @
        time.sleep(5)
        os.system('cls')
        res = list(islice(reversed(Lista_Links), 0, 24))
        res.reverse()
        for link  in res:
            print(Fore.BLUE + str(link))
        print(Fore.LIGHTGREEN_EX+"|| CASA SAPO SCRAPER ||")
        print(Fore.YELLOW + "RECOLHA DE LINKS EM PROCESSO")
        print("Links encontrados: " +Fore.BLUE+str(num_links))
    except:
        continue


pos_link = int()
for link in Lista_Links:
    pos_link+=1
    time.sleep(5)
    os.system('cls')
    print(Fore.LIGHTGREEN_EX+"|| CASA SAPO SCRAPER ||")
    print(Fore.YELLOW + "RASPANDO INFORMACAO DOS LINKS")
    print("Link: "+Fore.GREEN+str(pos_link)+"/" +Fore.WHITE+str(num_links))
    try:    
        # if "id=" in link:
        site = requests.get(link, headers=headers)
        soup = BeautifulSoup(site.content, 'html.parser')

        splited_link = link.split('.html')
        pre_id = splited_link[0]
        pre_id = pre_id.replace(pre_id[:-36], '')
        # print(pre_id)
        # time.sleep(10)

        # id = "CS"+splited_link[len(splited_link)-1]
        # print("ID: "+ id)
        # pre_id = pre_id.replace('-', '')
        id = "CS" + pre_id
        website = 1

        nav_infos = soup.find('a', class_='detail-header-nav-link').get_text()
        print(str(nav_infos))
        if "para Venda" in nav_infos:
            tipo_preco = 1
        if "para alugar" in nav_infos:
            tipo_preco = 2

        if "Apartamentos" in nav_infos:
            tipo_imovel = 1
        if "Moradias" in nav_infos:
                tipo_imovel = 2
        if "Quintas e Herdades" in nav_infos:
                tipo_imovel = 3

        Titulo_card = soup.find('div', class_='detail-section detail-title')
        titulo = str(Titulo_card.find('h1').get_text().replace('<h1>', ''))
        
        tipologia = 7
        if "T0" in nav_infos:
            tipologia = 1
        if "T1" in nav_infos:
            tipologia = 2
        if "T2" in nav_infos:
            tipologia = 3
        if "T3" in nav_infos:
            tipologia = 4
        if "T4" in nav_infos:
            tipologia = 5
        if "T5" in nav_infos:
            tipologia = 6
        
        preco = int(soup.find('div', class_='detail-title-price-value').get_text().replace(' €', '').replace('.', ''))

        Location_card = soup.find('div', class_='detail-title-location').get_text()
        splited_Location_card = Location_card.split(',')
        location = splited_Location_card[len(splited_Location_card)-1]
        if "Aveiro" in location:
            location = 1
        else:
            if "Beja" in location:
                location = 2
            else:
                if "Braga" in location:
                    location = 3
                else:
                    if "Bragança" in location:
                        location = 4
                    else:
                        if "Castelo Branco" in location:
                            location = 5
                        else:
                            if "Coimbra" in location:
                                location = 6
                            else:
                                if "Évora" in location:
                                    location = 7
                                else:
                                    if "Faro" in location:
                                        location = 8
                                    else:
                                        if "Guarda" in location:
                                            location = 9
                                        else:
                                            if "Leiria" in location:
                                                location = 10
                                            else:
                                                if "Lisboa" in location:
                                                    location = 11
                                                else:
                                                    if "Portalegre" in location:
                                                        location = 12
                                                    else:
                                                        if "Porto" in location:
                                                            location = 13
                                                        else:
                                                            if "Santarém" in location:
                                                                location = 14
                                                            else:
                                                                if "Setúbal" in location:
                                                                    location = 15
                                                                else:
                                                                    if "Viana do Castelo" in location:
                                                                        location = 16
                                                                    else:
                                                                        if "Vila Real" in location:
                                                                            location = 17
                                                                        else:
                                                                            location = 18


        Caracteristicas_Imoveis = soup.find_all('div', class_='detail-features-item')
        Dados_Imoveis = soup.find_all('div', class_='detail-main-features-item')
        Area_Bruta = ""
        Area_Util = ""
        N_wc = ""

        for item in Dados_Imoveis:
            Detail_title = item.find('div', class_="detail-main-features-item-title")
            # print("Detalhe: "+Detail_title.get_text())
            if "Área bruta" in Detail_title.get_text():                
                Area_Bruta = item.find('div', class_='detail-main-features-item-value').get_text().replace('m²', '')
                break
        for item in Dados_Imoveis:
            Detail_title = item.find('div', class_="detail-main-features-item-title")
            # print("Detalhe: "+Detail_title.get_text())
            if "Área útil" in Detail_title.get_text():                
                Area_Util = item.find('div', class_='detail-main-features-item-value').get_text().replace('m²', '')
                break
        for item in Caracteristicas_Imoveis:
        # print(item.get_text())
            if "Casa(s) de Banho:" in item.get_text():
                N_wc = item.get_text().replace('Casa(s) de Banho: ', '')
                break

        if Area_Bruta == "":
            Area_Bruta = "0"
        if Area_Util == "":
            Area_Util = "0"
        if N_wc == "":
            N_wc = "0"

        Descricao = ""
        try:
            Descricao = soup.find('div', class_='detail-section detail-description').get_text().replace('            ', '').replace('\n', '').replace('        Ver mais', '')
            Descricao = Descricao.replace(Descricao[0], '')
        except:
            Descricao = ""
        string_links=str()
        first = int(0)
        main = soup.find('main')
        links44 = main.find_all('picture')
        for f in links44:
            try:
                str_img = str(f.find('img'))
                splited_link_image = str_img.split('data-src="')
                if not ".JPG.webp" in splited_link_image[1]:
                    splited_link_image2 = splited_link_image[1].split('.jpg.webp"')
                    if first == 0:
                        string_links += splited_link_image2[0]+".jpg"
                        first = 1
                    else:
                        string_links += " || " + splited_link_image2[0] + ".jpg"
            except:
                continue
        
        print(string_links)
        # div_fotos = main.find('div', 'detail-media-imgs')
        # Links_Fotos = div_fotos.find_all('img')
        # Foto_Link = Links_Fotos[0].get('src').replace('.jpg.webp', '.jpg')

        Foto_Link = string_links
        Lista_Objectos.append( Obj_Imovel(titulo, preco, tipo_preco, location,
                                          tipo_imovel, tipologia, N_wc, Area_Bruta,
                                          Area_Util, website, Descricao, link, id, Foto_Link) )
        # else:
        #     continue
    except:
        continue


novos_imoveis = int()
atualizados_imoves = int()
for imovel in Lista_Objectos:

    TITULO = str(imovel.titulo) 
    PRECO = int(imovel.preco) 
    TIPO_PRECO = int(imovel.tipo_preco) 
    LOCALIZACAO = int(imovel.localizacao) 
    TIPO_IMOVEL = int(imovel.tipo_imovel) 
    TIPOLOGIA = int(imovel.tipologia) 
    N_WC = int(imovel.n_wc) 
    A_BRUTA = int(imovel.area_bruta) 
    A_UTIL = int(imovel.area_util) 
    WEBSITE = str(imovel.website) 
    DESCRICAO = str(imovel.descricao) 
    URL = str(imovel.url)
    ID = str(imovel.id)
    FOTO = str(imovel.foto)

    try:
        mycursor.execute("INSERT INTO properties (id, name, price, typeprice_id, location_id, typepropertie_id, typology_id, bathrooms,"+
                        " gross_area, usefull_area, propertywebsite_id, descricao, url, created_at)"+
                        " VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                         (ID, TITULO, PRECO, TIPO_PRECO, LOCALIZACAO, TIPO_IMOVEL, TIPOLOGIA, N_WC, A_BRUTA, A_UTIL, WEBSITE, DESCRICAO, URL,
                          datetime.now().strftime("%Y-%m-%d %H:%M:%S"))) 
        mydb.commit()
        print("Imóvel id: "+imovel.id+" adicionado a base de dados!")
        novos_imoveis += 1

        current_folder = os.path.dirname(os.path.abspath(__file__))
        try:
            os.makedirs(current_folder+"/sherlockhomes/public/uploads/"+ID)
        except FileExistsError:
            pass
        
        # imgURL = FOTO
        # urllib.request.urlretrieve(imgURL, current_folder+"/sherlockhomes/public/uploads/"+ID+"/"+ID+".jpg")
        links_fots = FOTO.split(' || ')
        fot_name = int(1)
        for link_fot in links_fots:
            fot_name = fot_name + 1
            urllib.request.urlretrieve(link_fot, current_folder+"/sherlockhomes/public/uploads/"+ID+"/"+str(fot_name)+".jpg")

    except:
        # print(Fore.RED+"!!!ERRO AO ADICIONAR IMOVEL NA BASE DE DADOS!!!\nLink do Imovel: "+imovel.url)
        Lista_Updates.append(imovel)
        print("Adicionado a lista de updates")
    # print("======================================================================================================\n\n")
print(Fore.LIGHTGREEN_EX+"|| CASA SAPO SCRAPER ||")
print("\n\n\n!!!INICIANDO UPDATES A DB!!!")

for imovel in Lista_Updates:

    PRECO = int(imovel.preco) 
    ID = str(imovel.id)
    

    try:
        mycursor.execute("UPDATE properties SET price = %s, updated_at = %s WHERE (id = %s)", (PRECO, datetime.now().strftime("%Y-%m-%d %H:%M:%S"), ID)) 
        mydb.commit()
        print("Imovel Atualizado")
        atualizados_imoves += 1
    except:
        print("!!!ERRO AO ATUALIZAR IMOVEL NA BASE DE DADOS!!!\nLink do Imovel: "+imovel.url) 

#*============================================================================================================================
os.system('cls')
print(Fore.LIGHTGREEN_EX+"|| CASA SAPO SCRAPER ||")
print(Fore.LIGHTGREEN_EX + "SCRAPING CONCLUIDO COM SUCESSO!")
print("\n\nImoveis Novos: " +Fore.GREEN+ str(novos_imoveis))
print("\n\nImoveis Atualizados: " +Fore.YELLOW+ str(atualizados_imoves))
input("Press Enter to continue...")