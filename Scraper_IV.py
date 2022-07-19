from asyncio.windows_events import NULL
from cProfile import label
from bs4 import BeautifulSoup
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
from itertools import count, islice


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
ListaQuerys_ImoVirtual = [

    # ! Lista sem ordem
    "https://www.imovirtual.com/comprar/apartamento/?search[filter_enum_rooms_num][0]=zero",
    "https://www.imovirtual.com/arrendar/apartamento/?search[filter_enum_rooms_num][0]=1",
    "https://www.imovirtual.com/comprar/moradia/?search[filter_enum_rooms_num][0]=2",
    "https://www.imovirtual.com/arrendar/moradia/?search[filter_enum_rooms_num][0]=3",
    "https://www.imovirtual.com/comprar/quintaeherdade/?search[filter_enum_rooms_num][0]=4",
    "https://www.imovirtual.com/arrendar/quintaeherdade/?search%5Bfilter_enum_rooms_num%5D%5B0%5D=6&search%5Bfilter_enum_rooms_num%5D%5B1%5D=7&search%5Bfilter_enum_rooms_num%5D%5B2%5D=8&search%5Bfilter_enum_rooms_num%5D%5B3%5D=9&search%5Bfilter_enum_rooms_num%5D%5B4%5D=more"


# =================================================

    # "https://www.imovirtual.com/comprar/apartamento/?search[filter_enum_rooms_num][0]=zero",
    # "https://www.imovirtual.com/comprar/apartamento/?search[filter_enum_rooms_num][0]=1",
    # "https://www.imovirtual.com/comprar/apartamento/?search[filter_enum_rooms_num][0]=2",
    # "https://www.imovirtual.com/comprar/apartamento/?search[filter_enum_rooms_num][0]=3",
    # "https://www.imovirtual.com/comprar/apartamento/?search[filter_enum_rooms_num][0]=4",
    # "https://www.imovirtual.com/comprar/apartamento/?search[filter_enum_rooms_num][0]=5",
    # "https://www.imovirtual.com/comprar/apartamento/?search%5Bfilter_enum_rooms_num%5D%5B0%5D=6&search%5Bfilter_enum_rooms_num%5D%5B1%5D=7&search%5Bfilter_enum_rooms_num%5D%5B2%5D=8&search%5Bfilter_enum_rooms_num%5D%5B3%5D=9&search%5Bfilter_enum_rooms_num%5D%5B4%5D=more",

    # "https://www.imovirtual.com/arrendar/apartamento/?search[filter_enum_rooms_num][0]=zero",
    # "https://www.imovirtual.com/arrendar/apartamento/?search[filter_enum_rooms_num][0]=1",
    # "https://www.imovirtual.com/arrendar/apartamento/?search[filter_enum_rooms_num][0]=2",
    # "https://www.imovirtual.com/arrendar/apartamento/?search[filter_enum_rooms_num][0]=3",
    # "https://www.imovirtual.com/arrendar/apartamento/?search[filter_enum_rooms_num][0]=4",
    # "https://www.imovirtual.com/arrendar/apartamento/?search[filter_enum_rooms_num][0]=5",
    # "https://www.imovirtual.com/arrendar/apartamento/?search%5Bfilter_enum_rooms_num%5D%5B0%5D=6&search%5Bfilter_enum_rooms_num%5D%5B1%5D=7&search%5Bfilter_enum_rooms_num%5D%5B2%5D=8&search%5Bfilter_enum_rooms_num%5D%5B3%5D=9&search%5Bfilter_enum_rooms_num%5D%5B4%5D=more",

    # "https://www.imovirtual.com/comprar/moradia/?search[filter_enum_rooms_num][0]=zero",
    # "https://www.imovirtual.com/comprar/moradia/?search[filter_enum_rooms_num][0]=1",
    # "https://www.imovirtual.com/comprar/moradia/?search[filter_enum_rooms_num][0]=2",
    # "https://www.imovirtual.com/comprar/moradia/?search[filter_enum_rooms_num][0]=3",
    # "https://www.imovirtual.com/comprar/moradia/?search[filter_enum_rooms_num][0]=4",
    # "https://www.imovirtual.com/comprar/moradia/?search[filter_enum_rooms_num][0]=5",
    # "https://www.imovirtual.com/comprar/moradia/?search%5Bfilter_enum_rooms_num%5D%5B0%5D=6&search%5Bfilter_enum_rooms_num%5D%5B1%5D=7&search%5Bfilter_enum_rooms_num%5D%5B2%5D=8&search%5Bfilter_enum_rooms_num%5D%5B3%5D=9&search%5Bfilter_enum_rooms_num%5D%5B4%5D=more",

    # "https://www.imovirtual.com/arrendar/moradia/?search[filter_enum_rooms_num][0]=zero",
    # "https://www.imovirtual.com/arrendar/moradia/?search[filter_enum_rooms_num][0]=1",
    # "https://www.imovirtual.com/arrendar/moradia/?search[filter_enum_rooms_num][0]=2",
    # "https://www.imovirtual.com/arrendar/moradia/?search[filter_enum_rooms_num][0]=3",
    # "https://www.imovirtual.com/arrendar/moradia/?search[filter_enum_rooms_num][0]=4",
    # "https://www.imovirtual.com/arrendar/moradia/?search[filter_enum_rooms_num][0]=5",
    # "https://www.imovirtual.com/arrendar/moradia/?search%5Bfilter_enum_rooms_num%5D%5B0%5D=6&search%5Bfilter_enum_rooms_num%5D%5B1%5D=7&search%5Bfilter_enum_rooms_num%5D%5B2%5D=8&search%5Bfilter_enum_rooms_num%5D%5B3%5D=9&search%5Bfilter_enum_rooms_num%5D%5B4%5D=more",
    
    # "https://www.imovirtual.com/comprar/quintaeherdade/?search[filter_enum_rooms_num][0]=zero",
    # "https://www.imovirtual.com/comprar/quintaeherdade/?search[filter_enum_rooms_num][0]=1",
    # "https://www.imovirtual.com/comprar/quintaeherdade/?search[filter_enum_rooms_num][0]=2",
    # "https://www.imovirtual.com/comprar/quintaeherdade/?search[filter_enum_rooms_num][0]=3",
    # "https://www.imovirtual.com/comprar/quintaeherdade/?search[filter_enum_rooms_num][0]=4",
    # "https://www.imovirtual.com/comprar/quintaeherdade/?search[filter_enum_rooms_num][0]=5",
    # "https://www.imovirtual.com/comprar/quintaeherdade/?search%5Bfilter_enum_rooms_num%5D%5B0%5D=6&search%5Bfilter_enum_rooms_num%5D%5B1%5D=7&search%5Bfilter_enum_rooms_num%5D%5B2%5D=8&search%5Bfilter_enum_rooms_num%5D%5B3%5D=9&search%5Bfilter_enum_rooms_num%5D%5B4%5D=more",
    
    # "https://www.imovirtual.com/arrendar/quintaeherdade/?search[filter_enum_rooms_num][0]=zero",
    # "https://www.imovirtual.com/arrendar/quintaeherdade/?search[filter_enum_rooms_num][0]=1",
    # "https://www.imovirtual.com/arrendar/quintaeherdade/?search[filter_enum_rooms_num][0]=2",
    # "https://www.imovirtual.com/arrendar/quintaeherdade/?search[filter_enum_rooms_num][0]=3",
    # "https://www.imovirtual.com/arrendar/quintaeherdade/?search[filter_enum_rooms_num][0]=4",
    # "https://www.imovirtual.com/arrendar/quintaeherdade/?search[filter_enum_rooms_num][0]=5",
    # "https://www.imovirtual.com/arrendar/quintaeherdade/?search%5Bfilter_enum_rooms_num%5D%5B0%5D=6&search%5Bfilter_enum_rooms_num%5D%5B1%5D=7&search%5Bfilter_enum_rooms_num%5D%5B2%5D=8&search%5Bfilter_enum_rooms_num%5D%5B3%5D=9&search%5Bfilter_enum_rooms_num%5D%5B4%5D=more"

    ]
Lista_Links = []

headers = {
    'User-Agent': "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36"}
num_links = int()

#?o seguinte código percorre todas as querys e guarda os links dos imóveis que serão alvos de scraping
for query in ListaQuerys_ImoVirtual:
    try: 
        site = requests.get(query, headers=headers)
        soup = BeautifulSoup(site.content, 'html.parser')
        div_Cards = soup.find('div', class_='col-md-content section-listing__row-content')
        Imoveis_All_Cards = div_Cards.find_all('article')
        link_for_braker = 0
        for card in Imoveis_All_Cards:
            if link_for_braker == 1: 
                break
            try:
                Imovel_Codigo_Link = card.find('a')
                link = Imovel_Codigo_Link.get('href')
                # if link[0] == "/":
                #     newlink = "https://casa.sapo.pt/" + link
                #     Lista_Links.append(newlink)
                #     num_links += 1
                #         # print(Fore.CYAN+"\n" + newlink)
                # else:
                #     Lista_Links.append(link)
                #     num_links += 1
                Lista_Links.append(link)
                num_links += 1
                link_for_braker += 1
            except:
                continue
        time.sleep(5)
        os.system('cls')
        res = list(islice(reversed(Lista_Links), 0, 24))
        res.reverse()
        for link  in res:
            print(Fore.BLUE + str(link))
        print(Fore.LIGHTGREEN_EX+"|| IMOVIRTUAL SCRAPER ||")
        print(Fore.YELLOW + "RECOLHA DE LINKS EM PROCESSO")
        print("Links encontrados: " +Fore.BLUE+str(num_links))
    except:
        continue

pos_link = int()
for link in Lista_Links:
    try:
        pos_link+=1
        time.sleep(5)
        os.system('cls')
        print(Fore.LIGHTGREEN_EX+"|| IMOVIRTUAL SCRAPER ||")
        print(Fore.YELLOW + "RASPANDO INFORMACAO DOS LINKS")
        print("Link: "+Fore.GREEN+str(pos_link)+Fore.WHITE+"/" +Fore.WHITE+str(num_links))

        
        splited_link = link.split('ID')
        splited_link = splited_link[len(splited_link)-1]
        splited_link = splited_link.split('.html')
        id = "IV" + splited_link[0]
       

        site = requests.get(link, headers=headers)
        soup = BeautifulSoup(site.content, 'html.parser')

        website = 2

        infos_up = soup.find('div', class_='css-1hbnbbd e1je57sb7').get_text()
        if "Apartamento" in infos_up:
            tipo_imovel = 1
        if "Moradia" in infos_up:
            tipo_imovel = 2
        if "Quintas e herdades" in infos_up:
            tipo_imovel = 3
        if "para comprar" in infos_up:
            tipo_preco = 1
        if "para arrendar" in infos_up:
            tipo_preco = 2

        caracts = soup.find('div', class_='css-1d9dws4 egzohkh2').get_text()
        
        tipologia = 7
        if "Tipologia:T0" in caracts:
            tipologia = 1
        if "Tipologia:T1" in caracts:
            tipologia = 2
        if "Tipologia:T2" in caracts:
            tipologia = 3
        if "Tipologia:T3" in caracts:
            tipologia = 4
        if "Tipologia:T4" in caracts:
            tipologia = 5
        if "Tipologia:T5" in caracts:
            tipologia = 6

        # if "Tipologia:T0" in caracts:
        #     tipologia = 1
        # else:
        #     if "Tipologia:T1" in caracts:
        #         tipologia = 2
        #     else:
        #         if "Tipologia:T2" in caracts:
        #             tipologia = 3
        #         else:
        #             if "Tipologia:T3" in caracts:
        #                 tipologia = 4
        #             else:
        #                 if "Tipologia:T4" in caracts:
        #                     tipologia = 5
        #                 else:
        #                     if "Tipologia:T5" in caracts:
        #                         tipologia = 6
        #                     else:
        #                         tipologia = 7

        # if "apartamento" in query:
        #         tipo_imovel = 1
        # else:
        #     if "moradia" in query:
        #         tipo_imovel = 2
        #     else:
        #         tipo_imovel = 3

        titulo = soup.find('h1', class_='css-11kn46p eu6swcv20').get_text()

        # if "t0"  or "T0" in str(titulo):
        #     tipologia = 1
        # else:
        #     if "t1"  or "T1" in str(titulo):
        #         tipologia = 2
        #     else:
        #         if "t2"  or "T2" in str(titulo):
        #             tipologia = 3
        #         else:
        #             if "t3"  or "T3" in str(titulo):
        #                 tipologia = 4
        #             else:
        #                 if "t4"  or "T4" in str(titulo):
        #                     tipologia = 5
        #                 else:
        #                     if "t5"  or "T5" in str(titulo):
        #                         tipologia = 6
        #                     else:
        #                         tipologia = 7

        preco = soup.find('strong', class_='css-8qi9av eu6swcv19').get_text().replace(' ', '').replace('€', '')
        splited_loc = soup.find('div', class_='css-1k12nzr eu6swcv15').get_text().split(',')
        localizacao = splited_loc[len(splited_loc)-1]

        if "Aveiro" in localizacao:
            localizacao = 1
        else:
            if "Beja" in localizacao:
                localizacao = 2
            else:
                if "Braga" in localizacao:
                    localizacao = 3
                else:
                    if "Bragança" in localizacao:
                        localizacao = 4
                    else:
                        if "Castelo Branco" in localizacao:
                            localizacao = 5
                        else:
                            if "Coimbra" in localizacao:
                                localizacao = 6
                            else:
                                if "Évora" in localizacao:
                                    localizacao = 7
                                else:
                                    if "Faro" in localizacao:
                                        localizacao = 8
                                    else:
                                        if "Guarda" in localizacao:
                                            localizacao = 9
                                        else:
                                            if "Leiria" in localizacao:
                                                localizacao = 10
                                            else:
                                                if "Lisboa" in localizacao:
                                                    localizacao = 11
                                                else:
                                                    if "Portalegre" in localizacao:
                                                        localizacao = 12
                                                    else:
                                                        if "Porto" in localizacao:
                                                            localizacao = 13
                                                        else:
                                                            if "Santarém" in localizacao:
                                                                localizacao = 14
                                                            else:
                                                                if "Setúbal" in localizacao:
                                                                    localizacao = 15
                                                                else:
                                                                    if "Viana do Castelo" in localizacao:
                                                                        localizacao = 16
                                                                    else:
                                                                        if "Vila Real" in localizacao:
                                                                            localizacao = 17
                                                                        else:
                                                                            localizacao = 18

        caracteristicas = soup.find('div', class_='css-1d9dws4 egzohkh2').find_all('div', class_='css-18h1kfv ev4i3ak3')

        area_util = "0"
        area_bruta = "0"
        n_wc = "0"
        try:
            for item in caracteristicas:
                if "Área útil (m²):" in item.get_text():
                    area_util = item.get_text().replace('Área útil (m²):', '').replace('m²', '').replace(' ', '')
        except:
            continue
        try:
            for item in caracteristicas:
                if "Área bruta (m²):" in item.get_text():
                    area_bruta = item.get_text().replace('Área bruta (m²):', '').replace('m²', '').replace(' ', '')
        except:
            continue
        try:
            for item in caracteristicas:
                if "Área de terreno (m²):" in item.get_text():
                    area_bruta = item.get_text().replace('Área de terreno (m²):', '').replace('m²', '').replace(' ', '')
        except:
            continue
        try:
            for item in caracteristicas:
                if "Casas de Banho:" in item.get_text():
                    n_wc = item.get_text().replace('Casas de Banho:', '').replace(' ', '')
        except:
            continue

        descricao = ""
        try:
            descricao = soup.find('section', class_="css-1vfwbw8 e1r1048u3")
            descricao.find('h2').decompose()
            splitedLines_descricao = descricao.get_text().splitlines()
            descricao = ""
            for line in splitedLines_descricao:
                descricao += (" " + line)
            descricao = descricao.replace('  ', ' ')
            if len(descricao) > 5000:
                descricao = descricao[:5000]
        except:
            descricao = ""
            continue
        
        link_foto = soup.find('picture').find_all('source')[1].get('srcset')
        print(link_foto)
       

        # print(len( soup.find_all('picture').find_all('source')[1].get('srcset')))
        # thumbnail = soup.find_all('img', class_="image-gallery-thumbnails-container")
        # for foto in thumbnail:
        # print(soup)

        Lista_Objectos.append( Obj_Imovel(titulo, preco, tipo_preco, localizacao,
                                              tipo_imovel, tipologia, n_wc, area_bruta,
                                              area_util, website, descricao, link, id, link_foto) )
    except:
        print("ERRO")
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
        
        imgURL = FOTO
        urllib.request.urlretrieve(imgURL, current_folder+"/sherlockhomes/public/uploads/"+ID+"/"+ID+".jpg")

    except:
        # print(Fore.RED+"!!!ERRO AO ADICIONAR IMOVEL NA BASE DE DADOS!!!\nLink do Imovel: "+imovel.url)
        Lista_Updates.append(imovel)
        print("Adicionado a lista de updates")
    # print("======================================================================================================\n\n")
print(Fore.LIGHTGREEN_EX+"|| IMOVIRTUAL SCRAPER ||")
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
print(Fore.LIGHTGREEN_EX+"|| IMOVIRTUAL SCRAPER ||")
print(Fore.LIGHTGREEN_EX + "SCRAPING CONCLUIDO COM SUCESSO!")
print("\n\nImoveis Novos: " +Fore.GREEN+ str(novos_imoveis))
print("\n\nImoveis Atualizados: " +Fore.YELLOW+ str(atualizados_imoves))
input("Press Enter to continue...")