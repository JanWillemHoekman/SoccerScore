FROM node:20.9-alpine as build

WORKDIR /app

COPY ./src/frontend/ ./

RUN npm install
RUN npm run build


FROM node:20.9-alpine as run

WORKDIR /app

COPY --from=build /app/package.json ./package.json
COPY --from=build /app/build ./build

RUN npm install

EXPOSE 3000

ENTRYPOINT [ "npm", "run", "start" ]