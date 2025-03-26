document.addEventListener('alpine:init', () => {
   Alpine.data('frontPage', () => ({
      restAPI: globals.restAPI,
      searchValue: '',
      filterMap: {
         search: '',
         genre: '',
         seasonYear: '',
         season: '',
         format: '',
      },
      searchListElement: document.querySelector('#anime-list-container'),

      filter() {
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
               this.searchValue = data
               this.searchListElement.innerHTML = data
               console.log(this.searchValue)
            })
            .catch((error) => {
               console.error('Error while fetching:', error)
            })
      },
   }))
})
