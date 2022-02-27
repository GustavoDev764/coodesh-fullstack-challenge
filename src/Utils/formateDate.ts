export default function formateDate(data:string){
  try {
    const dt = data.split('-');
    return `${dt[2]}/${dt[1]}/${dt[0]}`;
  } catch (error) {
    return 'error';
  }
  
}

export function formateDateTime(data:string) {
  try { 
    const res = data.split("T");
    const dt = res[0].split('-');
    return `${dt[2]}/${dt[1]}/${dt[0]} ${res[1].slice(0,8)}`;
  } catch (error) {
    return 'error';
  }
}