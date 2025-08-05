# AnimeList - WordPress Theme

A WordPress theme that integrates with the AniList API to display information about anime and manga.

## Description

**AnimeList** is a personal project that uses the AniList API to search and display lists of anime and manga.

## Technologies Used

-  **WordPress**: Base CMS
-  **PHP 7.4+**: Main language
-  **Tailwind CSS**: Utility CSS framework
-  **Webpack**: Asset bundler
-  **Alpine.js**: Minimalist JavaScript framework
-  **GraphQL**: For AniList API queries
-  **Composer**: PHP dependency management

## Project Structure

```
AnimeList/
├── core/                    # Main theme functionalities
│   ├── EnqueueScripts.php   # Asset loading
│   ├── TemplateHierarchy.php # Template hierarchy
│   ├── ThemeSupport.php     # Theme feature support
│   └── WPHead.php          # Head configurations
├── services/               # Services and integrations
│   ├── AniList/           # AniList API integration
│   ├── Anime/             # Anime-related classes
│   ├── GraphQL/           # GraphQL query builder
│   └── Request/           # HTTP client (cURL)
├── public/                # Public assets
│   ├── assets/            # CSS, JS and dependencies
│   ├── components/        # Reusable components
│   └── pages/            # Page templates
├── views/                # View system
├── utils/                # Utilities
└── vendor/               # Composer dependencies
```

## Installation

### Prerequisites

-  WordPress 5.0+
-  PHP 7.4+
-  Node.js 14+
-  Composer

### Installation Steps

1. **Clone the repository**

   ```bash
   git clone [repository-url]
   cd AnimeList
   ```

2. **Install PHP dependencies**

   ```bash
   composer install
   ```

3. **Install Node.js dependencies**

   ```bash
   npm install
   ```

4. **Compile assets**

   ```bash
   npm run assets
   ```

5. **Activate the theme in WordPress**
   -  Copy the `AnimeList` folder to `/wp-content/themes/`
   -  Activate the theme in the WordPress admin panel

## Development

### Available Scripts

```bash
# Compile CSS (Tailwind)
npm run css

# Compile JavaScript (Webpack)
npm run js

# Compile all assets
npm run assets

# Regenerate Composer autoload
npm run autoload
```

### Development Structure

-  **CSS**: Edit files in `public/assets/tailwind/`
-  **JavaScript**: Add scripts in `public/assets/scripts/`
-  **PHP**: Follow PSR-4 structure in `core/`, `services/`, `views/`

## Configuration

## AniList API

The theme integrates with the AniList GraphQL API to fetch:

-  Genre list
-  Trending anime
-  Popular season anime
-  Upcoming releases
-  Advanced filters
-  Detailed anime information

### Main Endpoints

-  `get_genres()`: List all available genres
-  `get_trending_now()`: Trending anime
-  `get_season_popular()`: Popular anime from current season
-  `get_upcoming_next_season()`: Upcoming releases
-  `get_filter()`: Advanced filtering system

## TODO List

-  [ ] Create trending now archive page
-  [ ] Create popular this season archive page
-  [ ] Create upcoming next season archive page
-  [ ] Create all time popular archive page
-  [ ] Create top 100 anime component

## License

This project is licensed under the GNU General Public License v2.0 - see the [LICENSE](LICENSE) file for details.

## Author

**Thunay Moreira de Soares**

-  Website: [https://thy8000.github.io/thunaymoreiradesoares2/](https://thy8000.github.io/thunaymoreiradesoares2/)
-  GitHub: [@thy8000](https://github.com/thy8000)

## Acknowledgments

-  [AniList](https://anilist.co/) for the free API
-  [WordPress](https://wordpress.org/) for the platform
-  [Tailwind CSS](https://tailwindcss.com/) for the CSS framework
-  WordPress and web development community

---
