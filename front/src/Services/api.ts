import axios from 'axios';

//const urlPath = 'http://localhost/coodesh-challenge-fullstack/api/public';

export const url = `${process.env.APP_URL}`;

const api = axios.create({
  baseURL: url,
});

export const apiAsync = axios.create({
  baseURL: '',
});

export function getApi(url:string) {
  return axios.create({
    baseURL: url,
  });
}

export default api;
