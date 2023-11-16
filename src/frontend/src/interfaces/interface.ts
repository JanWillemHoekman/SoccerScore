export interface Team {
    id: number;
    name: String;
}

export interface Season {
    id: number;
    name: String;
}

export interface Game {
    homeTeam: number;
    awayTeam: number;
    season: number;
    homeScore: number;
    awayScore: number;
}