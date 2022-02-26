/* eslint-disable @next/next/no-img-element */
import React from 'react';
import { IArticlesData } from '../interfaces/data';
import { formateDateTime } from '../Utils/formateDate';

interface Props{
  styles:any;
  item: IArticlesData;
}

const CardRight:React.FC<Props> = ({styles,item})=>{
  return(
    <div className={styles.itemMain}>
      <div className="d-flex justify-content-center">
        <div className={styles.itemCard}>            
          <div className={styles.itemText}>
            <label className={styles.titleCard}>{item.title}</label>
            <div className="d-flex justify-content-between">
              <div className={styles.subTitle}>{formateDateTime(`${item.updated_at}`)}</div>
              <div className={styles.subTitle}>{item.newsSite}</div>
            </div>
            <p className={styles.itemParagrafo}>{item.summary}</p>
            <div className="d-flex justify-content-start">
              <button 
                onClick={()=>{
                  window.open(`${item.url}`,'blank');
                }}
                type='button' 
                className="btn btn-primary">
                Ver mais
              </button>
            </div>
          </div>
          <div className="p-2">
          <img 
              className={styles.fotoarticle}
              src={`${item.imageUrl}`} 
              alt="Card image cap"></img>
          </div>
        </div>
      </div>
    </div>
  );
}

export default CardRight;