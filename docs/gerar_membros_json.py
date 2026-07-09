#!/usr/bin/env python3
"""
Gera docs/membros.json a partir de CLASID.xlsx.
Uso: python3 docs/gerar_membros_json.py

Requisitos: pip install openpyxl
"""

import json
import openpyxl

def normalizar_nome(nome):
    palavras = nome.strip().split()
    return ' '.join(p[0].upper() + p[1:].lower() if p else '' for p in palavras)

def extrair_iniciais(nome):
    partes = nome.split()
    if len(partes) >= 2:
        return (partes[0][0] + partes[-1][0]).upper()
    return (partes[0][:2] if partes else 'XX').upper()

TROFEUS_POOL = [
    {'icone': 'bi-trophy-fill',       'nome': 'Melhor Kwiz',           'cor': '#F2B24C'},
    {'icone': 'bi-book-fill',         'nome': 'Presença debates',      'cor': '#5B3FA8'},
    {'icone': 'bi-star-fill',         'nome': 'Leitor do Mês',         'cor': '#1B6E96'},
    {'icone': 'bi-award-fill',        'nome': 'Destaque do Trimestre', 'cor': '#E8456B'},
    {'icone': 'bi-chat-quote-fill',   'nome': 'Debatedor Incansável',  'cor': '#2E9E6B'},
    {'icone': 'bi-bookmark-star-fill','nome': 'Colecionador de Livros','cor': '#B87A00'},
    {'icone': 'bi-mortarboard-fill',  'nome': 'Mestre das Resenhas',   'cor': '#7B3FA8'},
    {'icone': 'bi-calendar-check-fill','nome': '100% presença',        'cor': '#1B6E96'},
    {'icone': 'bi-people-fill',       'nome': 'Embaixador do Clube',   'cor': '#D94A4A'},
    {'icone': 'bi-gem',               'nome': 'Leitor Diamante',       'cor': '#2A7B9E'},
]

OBJETIVOS = [
    'Ler pelo menos 1 livro por mês e sair da zona de conforto.',
    'Descobrir novos autores e expandir horizontes literários.',
    'Criar o hábito da leitura semanal e participar nos debates.',
    'Ler clássicos da literatura mundial.',
    'Ler 30 livros este ano e melhorar a escrita através das resenhas.',
    'Compreender melhor filosofia política através da leitura.',
    'Conhecer a literatura angolana em profundidade.',
    'Explorar o existencialismo e a filosofia contemporânea.',
    'Ler romances clássicos e melhorar o vocabulário.',
    'Ler mais fantasia e ficção científica.',
]

ESTADOS = ['ativo', 'ativo', 'ativo', 'ativo', 'em_risco', 'inativo', 'fantasma']
MESES  = ['jan','fev','mar','abr','mai','jun','jul','ago','set','out','nov','dez']

def gerar_membro(id_clas, nome_raw):
    nome = normalizar_nome(nome_raw)
    iniciais = extrair_iniciais(nome)
    num = int(id_clas.replace('CLAS', ''))

    membro_desde = f"{MESES[num % 12]}/{2024 + (num % 3)}"
    estado = ESTADOS[num % len(ESTADOS)]
    leituras = (num * 7 + 3) % 50
    debates = max(0, (num * 3 + 5) % 20)
    eventos = max(0, (num * 2 + 7) % 15)
    objetivo = OBJETIVOS[num % len(OBJETIVOS)]

    trofeus = []
    if leituras > 20: trofeus.append(TROFEUS_POOL[0])
    if debates  > 5:  trofeus.append(TROFEUS_POOL[4])
    if eventos  > 5:  trofeus.append(TROFEUS_POOL[7])
    if leituras > 35: trofeus.append(TROFEUS_POOL[9])

    return {
        'nome': nome, 'iniciais': iniciais, 'processo': id_clas,
        'membro_desde': membro_desde, 'estado': estado,
        'objetivo': objetivo, 'leituras': leituras, 'debates': debates,
        'eventos': eventos, 'trofeus': trofeus, 'historico': [], 'resenhas': [],
    }

def main():
    import sys
    origem = sys.argv[1] if len(sys.argv) > 1 else 'CLASID.xlsx'
    destino = sys.argv[2] if len(sys.argv) > 2 else 'membros.json'

    wb = openpyxl.load_workbook(origem)
    ws = wb.active

    membros = {}
    for row in ws.iter_rows(min_row=2, values_only=True):
        id_clas, nome = row
        if not id_clas or not nome or 'Reservado' in str(nome):
            continue
        membros[id_clas] = gerar_membro(id_clas.strip(), nome.strip())

    with open(destino, 'w') as f:
        json.dump(membros, f, ensure_ascii=False, indent=2)

    print(f'{len(membros)} membros exportados para {destino}')

if __name__ == '__main__':
    main()