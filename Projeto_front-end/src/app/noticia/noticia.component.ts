import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ServicesService } from '../service.service';

@Component({
  selector: 'app-noticia',
  templateUrl: './noticia.component.html',
  styleUrls: ['./noticia.component.scss']
})
export class NoticiaComponent implements OnInit {

  private _id: number = 0
  public titulo: string | undefined
  public sub_titulo: string | undefined
  public imagem: string | undefined
  public texto: string | undefined


  constructor(
    private _activetedRoute: ActivatedRoute,
    private _services: ServicesService
  ) {
    this._activetedRoute.params.subscribe((data:any) => {
      this._id = data['id']
    })
  }

  ngOnInit(): void {
    this.getNoticia()
  }

  public getNoticia() {
    this._services.getNoticia(this._id).subscribe((data: any) => {
      if (data['status'] == 'success') {
          this.titulo = data['noticia']['titulo']
          this.sub_titulo = data['noticia']['sub_titulo']
          this.imagem = data['noticia']['imagem']
          this.texto = data['noticia']['texto']
      }
    })

  }

}
