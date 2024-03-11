import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { map, retry, timeout } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ServicesService {

  private httpOptions = {
    headers: new HttpHeaders({
      'Content-type': 'application/json',
      'Authorization': '4e692ca25aba'
    })
  }

  constructor(
    private http: HttpClient
  ) { }

  postCliente(dados: any) {
    // const httpOptions = {
    //   headers: new HttpHeaders({
    //     'Content-type' : 'application/json'
    //   }) 
    // }

    const url = 'http://localhost/api_jornal/clientes/'

    return this.http.post(url, dados, this.httpOptions)
      .pipe(
        map(
          (res: any) => res
        ),
        retry(3),
        timeout(5000)

      )
  }

  getLogin(email: any, senha: any) {

    const url = 'http://localhost/api_jornal/clientes/?email=' + email + '&senha=' + btoa(senha)

    return this.http.get(url, this.httpOptions)
      .pipe(
        map(
          (res: any) => res
        ),
        retry(3),
        timeout(5000)
      )

  }

  getNoticia(id: number) {
    const url = 'http://localhost/api_jornal/noticia/?id=' + id

    return this.http.get(url, this.httpOptions)
      .pipe(
        map(
          (res: any) => res
        ),
        retry(3),
        timeout(5000)
      )
  }

  getNoticias() {
    const url = 'http://localhost/api_jornal/noticia/'

    return this.http.get(url, this.httpOptions)
      .pipe(
        map(
          (res: any) => res
        ),
        retry(3),
        timeout(5000)
      )
  }

}

