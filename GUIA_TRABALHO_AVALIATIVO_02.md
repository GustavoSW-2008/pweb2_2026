# Guia de Apresentação e Entrega - Trabalho Avaliativo 02 (Laravel)
**Disciplina:** Desenvolvimento de Sistemas II  
**Professor:** Jackson Meires  
**Instituição:** IFSC Câmpus Chapecó  
**Tema:** Loja de Sofás (Pausa Sofás)

---

## 📋 Resumo dos Critérios Avaliativos Atendidos (Nota 10/10)

| Item | Critério | Como foi implementado no projeto |
| :--- | :--- | :--- |
| **1** | **Organização do Código (1,0 pt)** | Padrão MVC limpo no estilo direto de sala de aula, sem Service/Repository Pattern ou complexidades desnecessárias. Toda lógica nos Controllers, Models com `$fillable` e relacionamentos Eloquent. |
| **2** | **Layout Bootstrap 5 (1,0 pt)** | Responsivo em **Bootstrap 5.3** com **Bootstrap Icons**, layout herdado de `main.blade.php`, cards de métricas no dashboard, tabelas hover e alertas de validação/sucesso. |
| **3** | **5 CRUDs Completos (3,0 pts)** | **1. Categorias** (nome, descrição)<br>**2. Fornecedores** (razao_social, nome_fantasia, cnpj, email_contato, telefone)<br>**3. Clientes** (nome, cpf, telefone, email, data_nascimento, imagem)<br>**4. Endereços** (cliente_id, rua, numero, bairro, cidade, cep)<br>**5. Sofás** (categoria_id, fornecedor_id, modelo, cor, preco, quantidade_estoque, imagem).<br>Todos com Salvar, Listar, Buscar, Editar e Excluir. |
| **4** | **Upload de Imagens (Incluso)** | 1. **Sofás:** Formulário com `enctype="multipart/form-data"`, miniatura na listagem, preview na edição e exclusão do arquivo na Storage (`Storage::disk('public')->delete(...)`) ao excluir.<br>2. **Clientes:** Upload de foto de perfil, miniatura/avatar na listagem, preview na edição e exclusão física na Storage ao excluir. |
| **5** | **Busca Funcional (Incluso)** | Todas as 5 telas de listagem (`index`) possuem campo de busca funcional via parâmetro GET `?search=`, filtrando registros no banco de dados com `$query->where('...', 'like', "%{$search}%")`. |
| **6** | **Validação de Dados (0,5 pt)** | Validações diretas nos métodos dos Controllers com `$request->validate([...])`, mensagens de erro exibidas no Blade através de `@error` e alerta de resumo no layout principal. |
| **7** | **Relacionamentos Eloquent (1,0 pt)** | • **1:1 (Um para Um):** `Cliente` $\leftrightarrow$ `Endereco` (`hasOne` / `belongsTo`).<br>• **1:N (Um para Muitos):** `Categoria` $\to$ `Sofa` (`hasMany` / `belongsTo`) e `Fornecedor` $\to$ `Sofa` (`hasMany` / `belongsTo`).<br>Nunca exibe IDs estrangeiros nas views (exibe `$sofa->categoria->nome`, `$sofa->fornecedor->nome_fantasia`, etc.). |
| **8** | **Relatórios em PDF (1,0 pt)** | 1. **Relatório de Sofás em Estoque:** Rota `/sofas/relatorio` via DomPDF com modelos, fornecedores, saldo e valor em estoque.<br>2. **Relatório de Clientes:** Rota `/clientes/relatorio` via DomPDF com lista de clientes, contatos e endereços. |
| **9** | **Gráficos com Chart.js (1,0 pt)** | 1. **Gráfico em Pizza (Pie):** Distribuição de modelos de sofás por categoria.<br>2. **Gráfico em Barras (Bar):** Quantidade de modelos de sofás por fornecedor parceiro.<br>Ambos com Chart.js direto no Blade integrados ao Dashboard. |
| **10** | **Sistema Aberto / Sem Login** | Sem barreiras de autenticação, facilitando a navegação e correção direta pelo professor. |

---

## 🎤 Roteiro de Apresentação (5 a 10 Minutos)

1. **Abertura (1 minuto):**
   - Apresente o tema do sistema: **Pausa Sofás**, loja especializada no comércio de estofados em Chapecó-SC.
   - Mostre a navegação direta pelo menu superior com acesso aos 5 módulos.

2. **Demonstração do Dashboard e Gráficos (2 minutos):**
   - Mostre os cards com as contagens das tabelas (Categorias, Fornecedores, Clientes, Endereços, Sofás e Total de Estoque).
   - Apresente os **dois gráficos com tipos diferentes**:
     - *Gráfico de Pizza:* Sofás por Categoria.
     - *Gráfico de Barras:* Sofás por Fornecedor.
   - Mostre as tabelas de resumo dos últimos sofás e últimos clientes cadastrados.

3. **Demonstração dos CRUDs e Relacionamentos (3 minutos):**
   - **Upload de Imagens:** Cadastre um Sofá anexando uma foto e edite um Cliente anexando foto de perfil. Mostre a foto aparecendo na listagem e na edição.
   - **Relacionamento 1:1:** Cadastre um **Endereço**, mostrando o select de Clientes que já vincula 1:1 e exibe o nome do cliente na listagem.
   - **Relacionamento 1:N:** Cadastre um **Sofá**, selecionando a Categoria e o Fornecedor. Mostre que na listagem aparecem os nomes reais (ex: *Herval Estofados*, *Retrátil e Reclinável*) e nunca os IDs numéricos.
   - **Busca:** Faça uma busca rápida pelo campo `?search=` em qualquer listagem (ex: buscar modelo de sofá ou nome de cliente).
   - **Exclusão com remoção de arquivo:** Ao deletar um registro com foto, o arquivo físico é apagado de `storage/app/public/`.

4. **Demonstração dos Relatórios em PDF (1 minuto):**
   - Clique em **"Relatórios PDF -> Relatório de Sofás"** e **"Relatório de Clientes"**.
   - Mostre os documentos PDF gerados e formatados pelo DomPDF.

5. **Explicação do Código-Fonte (2 minutos):**
   - Mostre as Migrations em `database/migrations/` com as foreign keys.
   - Mostre os Models em `app/Models/` com `hasOne`, `belongsTo` e `hasMany`.
   - Mostre os Controllers com métodos REST padrão e `$request->validate([...])`.

---

## 📦 Checklist de Entrega

- [x] Script do banco exportado: `db_pweb2_2026.sql` (gerado na raiz do projeto).
- [ ] Compactar a pasta do projeto em `.zip` (excluindo a pasta `vendor`).
- [ ] Colocar o `.zip` e o `db_pweb2_2026.sql` em uma pasta no **Google Drive**.
- [ ] **IMPORTANTE:** Certifique-se de definir a permissão da pasta no Google Drive para **"Qualquer pessoa com o link pode ver"**.
- [ ] Submeter no SIGAA / Classroom com o link do repositório no GitHub.
