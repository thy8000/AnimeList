document.addEventListener('alpine:init', () => {
   Alpine.data('frontPage', () => ({
      restAPI: globals.restAPI,
      searchValue: '',
      filterMap: {
         search: '',
         genre: 'Any',
         seasonYear: '0',
         season: 'Any',
         format: 'Any',
      },
      searchListElement: document.querySelector('#anime-list-container'),

      filter() {
         this.clearData()

         if (this.isFilterEmpty()) {
            return
         }

         // TODO: ADICIONAR LOADING NA REQUEST
         const response = fetch(`${this.restAPI}anilist/api/search`, {
            method: 'POST',
            headers: {
               'Content-Type': 'application/json',
            },
            body: JSON.stringify({
               filter: {
                  search: this.filterMap.search ?? '',
                  genre: this.filterMap.genre ?? '',
                  seasonYear: this.filterMap.seasonYear ?? '',
                  season: this.filterMap.season ?? '',
                  format: this.filterMap.format ?? '',
               },
            }),
         })
            .then((response) => {
               if (!response.ok) {
                  throw new Error(`HTTP error! Status: ${response.status}`)
               }
               return response.json()
            })
            .then((data) => {
               this.searchValue = true
               this.searchListElement.innerHTML = data
            })
            .catch((error) => {
               // TODO: ESTILIZAR MENSAGEM DE ERRO
               console.error('Error while fetching:', error)
               this.searchValue = true
               this.searchListElement.innerHTML =
                  '<h1 style="color: white;">Não foi encontrado nenhum resultado para sua busca</h1>'
            })
      },

      clearData() {
         this.searchListElement.innerHTML = ''
      },

      isFilterEmpty() {
         const defaultValues = {
            search: '',
            genre: 'Any',
            seasonYear: '0',
            season: 'Any',
            format: 'Any',
         }

         console.log(this.filterMap)

         return Object.entries(this.filterMap).every(([key, value]) => value === defaultValues[key])
      },
   }))
})
