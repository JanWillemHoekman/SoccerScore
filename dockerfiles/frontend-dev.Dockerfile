FROM node:20.9

WORKDIR /app

COPY ./src/frontend/ ./

RUN npm install

EXPOSE 5173

ENTRYPOINT [ "npm", "run", "dev.host"  ]