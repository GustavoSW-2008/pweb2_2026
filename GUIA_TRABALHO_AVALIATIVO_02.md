# Guia de Apresentação e Entrega - Trabalho Avaliativo 02 (Laravel)

## 📌 Credenciais de Acesso ao Sistema
- **E-mail:** `admin@pausasofas.com`
- **Senha:** `12345678`

---

## 📋 Resumo dos Critérios Avaliativos Atendidos (Nota 10/10)

| Item | Critério | Como foi implementado no projeto |
| :--- | :--- | :--- |
| **1** | **Organização do Código (1,0 pt)** | Padrão MVC limpo, PSR-12, Models com relacionamentos Eloquent, Controllers desacoplados, validações e rotas organizadas. |
| **2** | **Layout Profissional (1,0 pt)** | Responsivo em **Bootstrap 5.3** com **Bootstrap Icons**, paleta de cores corporativa, cards de métricas, alertas dismissibles de feedback. |
| **3** | **5 CRUDs Completos (3,0 pts)** | 1. Clientes (6 campos)<br>2. Fornecedores (3 campos)<br>3. Sofás (5 campos)<br>4. Vendas (6 campos - Novo)<br>5. Fichas Técnicas (6 campos - Novo). Todos com Salvar, Listar, Buscar, Editar e Excluir. |
| **4** | **Upload de Imagens (Incluso)** | 1. **Sofás:** Upload no formulário, preview na edição, miniatura na listagem e exclusão do arquivo na Storage ao deletar.<br>2. **Clientes:** Foto de perfil, preview na edição, avatar na listagem e exclusão física na Storage ao deletar. |
| **5** | **Busca Funcional (Incluso)** | Todas as 5 telas de listagem contam com formulário de busca funcional com filtro multi-coluna (ex: buscar por nome, CPF, modelo, tecido, etc.). |
| **6** | **Validação de Dados (0,5 pt)** | Validações em todos os formulários com mensagens de erro customizadas em português (`validateForm`) e alertas amigáveis na view. |
| **7** | **Relacionamentos Eloquent (1,0 pt)** | • **1:1 (Um para Um):** `Sofa` $\leftrightarrow$ `FichaTecnica` (`hasOne` / `belongsTo`).<br>• **1:N (Um para Muitos):** `Fornecedor` $\to$ `Sofa`, `Cliente` $\to$ `Venda`, `Sofa` $\to$ `Venda`. Exibição de nomes em vez de IDs e uso de selects em formulários. |
| **8** | **Relatórios em PDF (1,0 pt)** | 1. **Relatório de Sofás:** Download via DomPDF com especificações e preços.<br>2. **Relatório de Vendas:** Download via DomPDF com resumo financeiro e pedidos. |
| **9** | **Gráficos com Larapex (1,0 pt)** | 1. **Gráfico em Pizza (PieChart):** Distribuição de modelos de sofás por fornecedor.<br>2. **Gráfico em Barras (BarChart):** Faturamento total por modelo de sofá. Ambos utilizando dados reais do MySQL e integrados ao Dashboard. |
| **10** | **Session / Autenticação (Objetivo)** | `LoginController` completo com sessão, logout e proteção de rotas com middleware `auth`. |

---

## 🎤 Roteiro de Apresentação (5 a 10 Minutos)

1. **Abertura (1 minuto):**
   - Apresente o tema do sistema: **Pausa Sofás**, loja de comércio de sofás, controle de fornecedores, fichas técnicas de acabamento e histórico de vendas.
   - Faça login com as credenciais: `admin@pausasofas.com` e senha `12345678`.

2. **Demonstração do Dashboard e Gráficos (2 minutos):**
   - Mostre os cards de contadores (Clientes, Fornecedores, Sofás, Vendas, Fichas Técnicas e Faturamento).
   - Destaque os **dois gráficos com formatos diferentes**:
     - *Gráfico de Pizza:* Sofás por Fornecedor.
     - *Gráfico de Barras:* Faturamento por Modelo de Sofá.
   - Abra as telas individuais de gráficos pelo menu "Gráficos".

3. **Demonstração dos CRUDs e Relacionamentos (3 minutos):**
   - **Upload de Imagens:** Cadastre ou edite um Sofá e um Cliente anexando uma imagem. Mostre a imagem na listagem e na edição.
   - **Relacionamento 1:1:** Mostre a tela de **Fichas Técnicas**, explicando que cada sofá só pode ter uma única ficha técnica vinculada.
   - **Relacionamento 1:N:** Mostre a tela de **Vendas**, demonstrando os selects que trazem os nomes dos clientes e dos sofás em vez de IDs, e o cálculo automático do valor total.
   - **Busca:** Faça uma pesquisa em tempo real em uma das listagens (ex: buscar pelo nome de um cliente ou modelo).
   - **Exclusão de Arquivo:** Ao deletar um registro com imagem, o arquivo correspondente é removido do disco (`Storage::disk('public')->delete(...)`).

4. **Demonstração dos Relatórios em PDF (1 minuto):**
   - Clique em **"Relatórios PDF -> Relatório de Sofás"** ou **"Relatório de Vendas"**.
   - Mostre o arquivo `.pdf` baixado formatado e com os totais calculados.

5. **Explicação do Código-Fonte (2 minutos):**
   - Mostre as Migrations com chave estrangeira e unique constraint.
   - Mostre os relacionamentos nos Models: `hasOne` em `Sofa.php`, `belongsTo` em `FichaTecnica.php`, `hasMany` em `Fornecedor.php`.
   - Mostre as classes de gráfico em `app/Charts/` usando LarapexCharts.
   - Mostre os métodos `report()` nos controllers utilizando `Barryvdh\DomPDF\Facade\Pdf`.

---

## 📦 Checklist de Entrega

- [x] Script do banco exportado: `db_pweb2_2026.sql` (já gerado na raiz do projeto).
- [ ] Compactar a pasta do projeto em `.zip` (excluindo a pasta `vendor` se necessário para economizar espaço).
- [ ] Colocar o `.zip` e o `db_pweb2_2026.sql` em uma pasta no **Google Drive**.
- [ ] **IMPORTANTE:** Certifique-se de definir a permissão da pasta no Google Drive para **"Qualquer pessoa com o link pode ver"** (requisito obrigatório para não zerar).
- [ ] Criar arquivo `.txt` contendo o link do repositório no GitHub.
