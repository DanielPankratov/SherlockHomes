from bs4 import BeautifulSoup

from selenium import webdriver
# from selenium.webdriver.common.keys import Keys
import lxml
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.common.by import By
from selenium.webdriver.support import expected_conditions as EC

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
ListaQuerys_BPI = [
#!esta secção não está em ordem
    "https://bpiexpressoimobiliario.pt/comprar/apartamento/t0",
    "https://bpiexpressoimobiliario.pt/arrendar/apartamento/t1",
    "https://bpiexpressoimobiliario.pt/comprar/moradia/t2",
    "https://bpiexpressoimobiliario.pt/arrendar/moradia/t3",
    "https://bpiexpressoimobiliario.pt/comprar/quinta-herdade/t4",
    # "https://bpiexpressoimobiliario.pt/arrendar/quinta-herdade/t5",
    "https://bpiexpressoimobiliario.pt/arrendar/quinta-herdade/maior_t5"
#==============================================================================

    # "https://bpiexpressoimobiliario.pt/comprar/apartamento/t0",
    # "https://bpiexpressoimobiliario.pt/comprar/apartamento/t1",
    # "https://bpiexpressoimobiliario.pt/comprar/apartamento/t2",
    # "https://bpiexpressoimobiliario.pt/comprar/apartamento/t3",
    # "https://bpiexpressoimobiliario.pt/comprar/apartamento/t4",
    # "https://bpiexpressoimobiliario.pt/comprar/apartamento/t5",
    # "https://bpiexpressoimobiliario.pt/comprar/apartamento/maior_t5",

    # "https://bpiexpressoimobiliario.pt/arrendar/apartamento/t0",
    # "https://bpiexpressoimobiliario.pt/arrendar/apartamento/t1",
    # "https://bpiexpressoimobiliario.pt/arrendar/apartamento/t2",
    # "https://bpiexpressoimobiliario.pt/arrendar/apartamento/t3",
    # "https://bpiexpressoimobiliario.pt/arrendar/apartamento/t4",
    # "https://bpiexpressoimobiliario.pt/arrendar/apartamento/t5",
    # "https://bpiexpressoimobiliario.pt/arrendar/apartamento/maior_t5",
    
    # "https://bpiexpressoimobiliario.pt/comprar/moradia/t0",
    # "https://bpiexpressoimobiliario.pt/comprar/moradia/t1",
    # "https://bpiexpressoimobiliario.pt/comprar/moradia/t2",
    # "https://bpiexpressoimobiliario.pt/comprar/moradia/t3",
    # "https://bpiexpressoimobiliario.pt/comprar/moradia/t4",
    # "https://bpiexpressoimobiliario.pt/comprar/moradia/t5",
    # "https://bpiexpressoimobiliario.pt/comprar/moradia/maior_t5",

    # "https://bpiexpressoimobiliario.pt/arrendar/moradia/t0",
    # "https://bpiexpressoimobiliario.pt/arrendar/moradia/t1",
    # "https://bpiexpressoimobiliario.pt/arrendar/moradia/t2",
    # "https://bpiexpressoimobiliario.pt/arrendar/moradia/t3",
    # "https://bpiexpressoimobiliario.pt/arrendar/moradia/t4",
    # "https://bpiexpressoimobiliario.pt/arrendar/moradia/t5",
    # "https://bpiexpressoimobiliario.pt/arrendar/moradia/maior_t5",
    
    # "https://bpiexpressoimobiliario.pt/comprar/quinta-herdade/t0",
    # "https://bpiexpressoimobiliario.pt/comprar/quinta-herdade/t1",
    # "https://bpiexpressoimobiliario.pt/comprar/quinta-herdade/t2",
    # "https://bpiexpressoimobiliario.pt/comprar/quinta-herdade/t3",
    # "https://bpiexpressoimobiliario.pt/comprar/quinta-herdade/t4",
    # "https://bpiexpressoimobiliario.pt/comprar/quinta-herdade/t5",
    # "https://bpiexpressoimobiliario.pt/comprar/quinta-herdade/maior_t5",

    # "https://bpiexpressoimobiliario.pt/arrendar/quinta-herdade/t0",
    # "https://bpiexpressoimobiliario.pt/arrendar/quinta-herdade/t1",
    # "https://bpiexpressoimobiliario.pt/arrendar/quinta-herdade/t2",
    # "https://bpiexpressoimobiliario.pt/arrendar/quinta-herdade/t3",
    # "https://bpiexpressoimobiliario.pt/arrendar/quinta-herdade/t4",
    # "https://bpiexpressoimobiliario.pt/arrendar/quinta-herdade/t5",
    # "https://bpiexpressoimobiliario.pt/arrendar/quinta-herdade/maior_t5"
    
    ]
Lista_Links = []
headers = {
    'User-Agent': "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36"}
num_links = int()

driver = webdriver.Chrome()

for query in ListaQuerys_BPI:
    try:
        driver.get(query)
        if query == ListaQuerys_BPI[0]:
            try:
                initial_btns = driver.find_elements("class name", "css-16gbcdc")
                initial_btns[1].click()
            except:
                continue
        time.sleep(5)
        driver.execute_script("window.scrollTo(0, 1000);")
        try:
            WebDriverWait(driver, 20).until(EC.visibility_of_element_located((By.CLASS_NAME, "announce")))
        except:
            continue 

        page_source = driver.page_source
        # print(page_source)
        time.sleep(2)
        soup = BeautifulSoup(page_source, 'lxml')
        cards = soup.find_all('div', class_="announce")

        link_for_braker = 0 
        for card in cards:
            if link_for_braker == 1:
                break
            element_link = str(card.find("a"))
            plited_element_link = element_link.split('href="')
            plited_element_link_2 = plited_element_link[1].split('">')
            link = "https://bpiexpressoimobiliario.pt" + plited_element_link_2[0]
            Lista_Links.append(link)
            link_for_braker +=1
    except:
        continue   
    # driver.get(Lista_Links[0])
pos_link = int()
for lin in Lista_Links:
    pos_link+=1
    time.sleep(5)
    os.system('cls')
    print(Fore.LIGHTGREEN_EX+"|| CASA SAPO SCRAPER ||")
    print(Fore.YELLOW + "RASPANDO INFORMACAO DOS LINKS")
    print("Link: "+Fore.GREEN+str(pos_link)+"/" +Fore.WHITE+str(num_links))
    try:
        website = 3
        driver.get(lin)
        driver.execute_script("window.scrollTo(0, 1000);")
        # try:
        #     WebDriverWait(driver, 20).until(EC.visibility_of_element_located((By.CLASS_NAME, "announce")))
        # except:
        #     continue

        page_source = driver.page_source
        # print(page_source)
        time.sleep(2)
        soup = BeautifulSoup(page_source, 'lxml')
        announce_header = soup.find('section', class_='announce-header')
        titulo = announce_header.find('div', class_='col-12 col-lg-6 d-flex align-items-center').get_text()
        preco = announce_header.find('div', class_='announce-price').get_text()
        preco = preco.replace('€', '').replace(' ', '')
        preco = preco.encode('ascii', 'ignore').decode('ascii')
        print("preco: "+str(preco))
        text_loc = announce_header.find('span', class_='d-lg-none announce-simple-location').get_text()
        print(titulo)
        if "para Venda" in titulo:
            tipo_preco = 1
        if "para Arrendamento" in titulo:
            tipo_preco = 2
        
        splited_loc = text_loc.split(', ')
        location = splited_loc[0]
        loc = 18
        if "Aveiro" in location:
            loc = 1
        if "Beja" in location:
            loc = 2
        if "Braga" in location:
            loc = 3
        if "Bragança" in location:
            loc = 4
        if "Castelo Branco" in location:
            loc = 5
        if "Coimbra" in location:
            loc = 6
        if "Évora" in location:
            loc = 7
        if "Faro" in location:
            loc = 8
        if "Guarda" in location:
            loc = 9
        if "Leiria" in location:
            loc = 10
        if "Lisboa" in location:
            loc = 11
        if "Portalegre" in location:
            loc = 12
        if "Porto" in location:
            loc = 13
        if "Santarém" in location:
            loc = 14
        if "Setúbal" in location:
            loc = 15
        if "Viana do Castelo" in location:
            loc = 16
        if "Vila Real" in location:
            loc = 17
        
        print("location:"+str(loc))
        infos_on_link = lin.replace('https://bpiexpressoimobiliario.pt/', '')
        splited_infos_on_link = infos_on_link.split('/')
        tipo_imovel = splited_infos_on_link[0]
        tipologia = splited_infos_on_link[1]
        id = splited_infos_on_link[len(splited_infos_on_link)-1]
        

        if "apartamento" in tipo_imovel:
            tipo_imo = 1
        if "moradia" in tipo_imovel:
                tipo_imo = 2
        if "quinta-herdade" in tipo_imovel:
                tipo_imo = 3
        print("tipo_imovel:" + str(tipo_imo))

        tipology = 7
        if "t0" in tipologia:
            tipology = 1
        if "t1" in tipologia:
            tipology = 2
        if "t2" in tipologia:
            tipology = 3
        if "t3" in tipologia:
            tipology = 4
        if "t4" in tipologia:
            tipology = 5
        if "t5" in tipologia:
            tipology = 6
        
        
        print("tipologia:" + str(tipology))
        print(id)

        detalhes_f = soup.find('ul', class_='announce-details')
        detalhes_lis = detalhes_f.find_all('li')
        detalhes_text = []
        for d in detalhes_lis:
            detalhes_text.append(d.get_text())


        Area_Util = 0
        Area_Bruta = 0
        Wc = 0

        for i in detalhes_text:
            if "Área Bruta" in i:
                text_area_bruta = i.replace("Área Bruta", "")
                if "---" in text_area_bruta:
                    continue
                else:
                    clean_text_area_bruta = text_area_bruta.replace("m2", "").replace(" ", "")
                    Area_Bruta = int(clean_text_area_bruta)
            if "Área Útil" in i:
                text_area_util = i.replace("Área Útil", "")
                if "---" in text_area_util:
                    continue
                else:
                    clean_text_area_util = text_area_util.replace("m2", "").replace(" ", "")
                    Area_Util = int(clean_text_area_util)
            if "WC" in i:
                text_area_wc = i.replace("WC", "")
                if "---" in text_area_wc:
                    continue
                else:
                    clean_text_area_wc = text_area_wc.replace(" ", "")
                    Wc = int(clean_text_area_wc)
        print("Area_Bruta: "+ str(Area_Bruta))
        print("Area_Util: "+ str(Area_Util))
        print("Wc: "+ str(Wc))

        descricao = soup.find('div', class_='announce-description').get_text()
        if len(descricao) > 5000:
                descricao = descricao[:5000]


        section_fotos = soup.find('section', class_="announce-banner d-flex banner-size")
        links_fots = section_fotos.find_all('img')
        string_links=str()
        first = int(0)
        for f in links_fots:
            # print(f.get('src'))
            try:
                if first == 0:
                    string_links += f.get('src')
                    first = 1
                else:
                    string_links += " || " + f.get('src')
            except:
                continue
        print(string_links)
        print('deu')
    except:
        continue
    try:
        Lista_Objectos.append( Obj_Imovel(titulo, preco, tipo_preco, loc, tipo_imo, tipology, Wc, Area_Bruta, Area_Util, website, descricao, lin, id, string_links) )
    except:
        print("error send to Objects_List")

driver.close()
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
        
        links_fots = FOTO.split(' || ')
        fot_name = int(0)
        for link_fot in links_fots:
            fot_name = fot_name + 1
            urllib.request.urlretrieve(link_fot, current_folder+"/sherlockhomes/public/uploads/"+ID+"/"+str(fot_name)+".jpg")

        # imgURL = FOTO
        # urllib.request.urlretrieve(imgURL, current_folder+"/sherlockhomes/public/uploads/"+ID+"/"+ID+".jpg")

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