# 🎌 AnimeList - WordPress Theme

Um tema WordPress que integra com a API do AniList para exibir informações sobre animes e mangás.

## 📋 Descrição

O **AnimeList** é um projeto pessoal que utiliza a API do AniList para buscar e exibir listas de animes e mangás.

## 🛠️ Tecnologias Utilizadas

-  **WordPress**: CMS base
-  **PHP 7.4+**: Linguagem principal
-  **Tailwind CSS**: Framework CSS utilitário
-  **Webpack**: Bundler de assets
-  **Alpine.js**: Framework JavaScript minimalista
-  **GraphQL**: Para consultas à API do AniList
-  **Composer**: Gerenciamento de dependências PHP

## 📁 Estrutura do Projeto

```
AnimeList/
├── core/                    # Funcionalidades principais do tema
│   ├── EnqueueScripts.php   # Carregamento de assets
│   ├── TemplateHierarchy.php # Hierarquia de templates
│   ├── ThemeSupport.php     # Suporte a recursos do tema
│   └── WPHead.php          # Configurações do head
├── services/               # Serviços e integrações
│   ├── AniList/           # Integração com API do AniList
│   ├── Anime/             # Classes relacionadas a animes
│   ├── GraphQL/           # Builder de queries GraphQL
│   └── Request/           # Cliente HTTP (cURL)
├── public/                # Assets públicos
│   ├── assets/            # CSS, JS e dependências
│   ├── components/        # Componentes reutilizáveis
│   └── pages/            # Templates de páginas
├── views/                # Sistema de views
├── utils/                # Utilitários
└── vendor/               # Dependências do Composer
```

## 🚀 Instalação

### Pré-requisitos

-  WordPress 5.0+
-  PHP 7.4+
-  Node.js 14+
-  Composer

### Passos de Instalação

1. **Clone o repositório**

   ```bash
   git clone [url-do-repositorio]
   cd AnimeList
   ```

2. **Instale as dependências PHP**

   ```bash
   composer install
   ```

3. **Instale as dependências Node.js**

   ```bash
   npm install
   ```

4. **Compile os assets**

   ```bash
   npm run assets
   ```

5. **Ative o tema no WordPress**
   -  Copie a pasta `AnimeList` para `/wp-content/themes/`
   -  Ative o tema no painel administrativo do WordPress

## 🛠️ Desenvolvimento

### Scripts Disponíveis

```bash
# Compilar CSS (Tailwind)
npm run css

# Compilar JavaScript (Webpack)
npm run js

# Compilar todos os assets
npm run assets

# Regenerar autoload do Composer
npm run autoload
```

### Estrutura de Desenvolvimento

-  **CSS**: Edite os arquivos em `public/assets/tailwind/`
-  **JavaScript**: Adicione scripts em `public/assets/scripts/`
-  **PHP**: Siga a estrutura PSR-4 em `core/`, `services/`, `views/`

## 🔧 Configuração

## 📡 API do AniList

O tema integra com a API GraphQL do AniList para buscar:

-  Lista de gêneros
-  Animes em tendência
-  Animes populares da temporada
-  Próximos lançamentos
-  Filtros avançados
-  Informações detalhadas de animes

### Endpoints Principais

-  `get_genres()`: Lista todos os gêneros disponíveis
-  `get_trending_now()`: Animes em tendência
-  `get_season_popular()`: Animes populares da temporada atual
-  `get_upcoming_next_season()`: Próximos lançamentos
-  `get_filter()`: Sistema de filtros avançados

## 📄 Licença

Este projeto está licenciado sob a GNU General Public License v2.0 - veja o arquivo [LICENSE](LICENSE) para detalhes.

## 👨‍💻 Autor

**Thunay Moreira de Soares**

-  Website: [https://thy8000.github.io/thunaymoreiradesoares2/](https://thy8000.github.io/thunaymoreiradesoares2/)
-  GitHub: [@thy8000](https://github.com/thy8000)

## 🙏 Agradecimentos

-  [AniList](https://anilist.co/) pela API gratuita
-  [WordPress](https://wordpress.org/) pela plataforma
-  [Tailwind CSS](https://tailwindcss.com/) pelo framework CSS
-  Comunidade WordPress e de desenvolvimento web

---
