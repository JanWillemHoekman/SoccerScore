<script lang="ts">
    import { onMount } from "svelte";
    import type {Team, Season, Game} from '../interfaces/interface'
    
    let teams: Array<Team> = [];
    let seasons: Array<Season> = [];
    let games: Array<Game> = [];

    let newSeasonName: string = ""

    onMount(async () => {
        getTeams();
        getSeasons();
        getGames();
    });

    function getTeams(){
        fetch("https://soccerscore-api.dev.local/api/teams")
        .then(response => response.json())
        .then(data => {
            teams = data;
        }).catch(error => {
            console.log(error);
        });
    }
        
    function getSeasons(){
        fetch("https://soccerscore-api.dev.local/api/seasons")
        .then(response => response.json())
        .then(data => {
            seasons = data;
        }).catch(error => {
            console.log(error);
            return [];
        });
    }

    function getGames(){
        fetch("https://soccerscore-api.dev.local/api/games")
        .then(response => response.json())
        .then(data => {
            games = data;
        }).catch(error => {
            console.log(error);
            return [];
        });
    }

    async function deleteSeason(name: string){
        await fetch(`https://soccerscore-api.dev.local/api/seasons/${name}`, {
            method: "DELETE"
        });

        getSeasons();
    }

    async function createSeason(name: string){
        await fetch(`https://soccerscore-api.dev.local/api/seasons`, {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({"name": name})
        });

        getSeasons();
    }

</script>
    
<main>
    <h1>Teams</h1>
    <table>
        {#each teams as team}
        <tr>
            <td>{team.name}</td>
            <td></td>
        </tr>
        {/each}
    </table>
    <h1>Seasons</h1>
    <table>
        {#each seasons as season}
        <tr>
            <td>{season.name}</td>
            <td><button on:click={() => deleteSeason(season.name)}>Delete</button></td>
        </tr>
        {/each}
    </table>
    <input bind:value={newSeasonName} />
    <button on:click={() => createSeason(newSeasonName)}>Add season</button>
    <h1>Games</h1>
    <table>
        <thead>
            <th>Season</th>
            <th>Home Team</th>
            <th>Score</th>
            <th>Away Team</th>
        </thead>
        {#each games as game}
        <tr>
            <td>{seasons.find(season => { return season.id === game.season})?.name}</td>
            <td class="left">{teams.find(team => { return team.id === game.homeTeam})?.name}</td>
            <td>{game.homeScore} - {game.awayScore}</td>
            <td>{teams.find(team => { return team.id === game.awayTeam})?.name}</td>
        </tr>
        {/each}
    </table>
</main>

<style>
    .left{
        text-align: end;
    }

</style>