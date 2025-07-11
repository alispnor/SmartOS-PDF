# SmartOS-PDF 🚀

## 📘 Visão Geral

**SmartOS-PDF** é uma aplicação web desenvolvida com **PHP e Laravel** para gerar **Ordens de Serviço (OS) em formato PDF**, com fidelidade visual ao modelo original e controle rigoroso de quebras de página. É ideal para casos em que se deseja imprimir documentos com muitos itens de forma organizada e profissional.

---

## 🎯 Desafio Técnico

Este projeto foi desenvolvido como solução para um desafio técnico envolvendo:

- **Fidelidade Visual**: O PDF deve replicar exatamente o layout fornecido.
- **Conteúdo Dinâmico**: Suporte para mais de 80 itens com alturas variáveis de texto.
- **Quebras de Página Controladas**:
  - Margens superiores e inferiores fixas (mínimo 1 cm).
  - Nenhum item deve ser cortado entre páginas.
  - Cabeçalho aparece **somente na primeira página**.
  - Demais páginas mantêm a margem superior, sem o cabeçalho completo.

---

## 🛠️ Tecnologias

- **PHP 8.x**
- **Laravel 10.x / 11.x**
- **MySQL**
- **[wkhtmltopdf](https://wkhtmltopdf.org/)** – conversão de HTML em PDF
- **[Laravel Snappy](https://github.com/barryvdh/laravel-snappy)** – wrapper Laravel para wkhtmltopdf
- **WSL (Ubuntu/Linux no Windows)** – ambiente de desenvolvimento

---

## ✅ Funcionalidades Principais

- **Geração de PDFs de Alta Qualidade**
- **Layout Adaptativo para muitos itens**
- **Cabeçalhos e rodapés dinâmicos e configuráveis**
- **Código limpo e estruturado com princípios SOLID e Clean Code**

---

## ⚙️ Instalação e Configuração

### 🔧 Pré-requisitos

- PHP 8.x
- Composer
- MySQL
- WSL com Ubuntu
- `wkhtmltopdf` instalado

### 1. Clone o repositório

```bash
git clone https://github.com/alispnor/SmartOS-PDF.git
cd SmartOS-PDF
```

### 2. Instale dependências e configure o Laravel

```bash
composer install
cp .env.example .env
php artisan key:generate
```

### 3. Configure o banco de dados

Edite seu arquivo `.env` com suas credenciais:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aero_os_gen
DB_USERNAME=root
DB_PASSWORD=
```

Crie o banco:

```bash
mysql -u root -p
```

No prompt do MySQL:

```sql
CREATE DATABASE aero_os_gen CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
exit;
```

### 4. Instale o wkhtmltopdf

Desinstale versões antigas:

```bash
sudo apt remove --purge wkhtmltopdf
sudo apt autoremove
```

Baixe o `.deb` compatível com seu Ubuntu:  
👉 https://wkhtmltopdf.org/downloads.html

```bash
wget <LINK_DO_ARQUIVO_DEB>
sudo apt install ./<NOME_DO_ARQUIVO>.deb
```

Verifique o caminho do binário:

```bash
which wkhtmltopdf
```

Adicione no `.env`:

```env
WKHTMLTOPDF_BINARY="/usr/local/bin/wkhtmltopdf"  # Ou caminho retornado
```

### 5. Instale o Laravel Snappy

```bash
composer require barryvdh/laravel-snappy
php artisan vendor:publish --provider="Barryvdh\Snappy\ServiceProvider"
```

### 6. Configure o Snappy (`config/snappy.php`)

```php
'pdf' => [
    'enabled' => true,
    'binary'  => env('WKHTMLTOPDF_BINARY', '/usr/bin/wkhtmltopdf'),
    'timeout' => false,
    'options' => [
        'print-media-type'         => true,
        'enable-local-file-access' => true,
        'encoding'                 => 'UTF-8',
        'no-stop-slow-scripts'     => true,
        'enable-javascript'        => true,
    ],
    'keep-temp' => true,
    'env' => [
        'LANG' => env('SNAPPY_PDF_ENV_LANG', 'en_US.UTF-8'),
    ],
],
```

### 7. Configure o Service Provider e Services

Verifique se os seguintes arquivos existem e estão corretamente configurados:

- `app/Providers/PdfServiceProvider.php`
- `app/Contracts/PdfGenerator.php`
- `app/Services/Pdf/SnappyPdfGenerator.php`
- `app/Services/Pdf/ServiceOrderPdfService.php`

### 8. Execute migrações e seeders

```bash
php artisan migrate:fresh --seed
```

### 9. Limpe cache e rode o servidor

```bash
php artisan optimize:clear
php artisan serve
```

---

## 📄 Como Usar

Para gerar uma OS em PDF, acesse:

```
http://127.0.0.1:8000/os/{id}/pdf
```

Substitua `{id}` pelo ID de uma OS existente (ex: `1`, criada pelos seeders).

---

## 🐞 Depuração e Ajustes Finais

### 📂 HTML Temporário

Com `keep-temp` ativado, os arquivos são salvos em `/tmp`. No Windows:

```
\\wsl.localhost\Ubuntu\tmp\
```

Abra no navegador e use o DevTools para ajustar margens, tamanhos e quebras.

### 🎨 CSS

Edite os arquivos Blade:

- `pdf/partials/header.blade.php`
- `pdf/partials/footer.blade.php`
- `pdf/service-order.blade.php`

Ajuste propriedades como `width`, `height`, `margin`, `line-height`, `font-size`, etc.

### 🧪 Ajuste de Quebras

No arquivo `ServiceOrderPdfService.php`, configure:

- `margin-top`, `margin-bottom`
- `header-spacing`, `footer-spacing`

Verifique a altura real dos elementos no navegador.

---

## 🤝 Contribuição

Sinta-se à vontade para abrir **issues**, sugerir melhorias ou fazer pull requests.

---

## 📜 Licença

Este projeto está licenciado sob a licença ALI.