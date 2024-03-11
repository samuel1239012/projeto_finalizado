import { Component, OnInit } from '@angular/core';
import { ServicesService } from '../service.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {
  public noticias: any[] = []
  constructor(
    private _services: ServicesService
  ) { }

  ngOnInit(): void {
    this.getNoticias()
  }
  public getNoticias() {
    this._services.getNoticias().subscribe((data: any) => {
      if (data['status'] == 'success') {
        data['noticia'].forEach((element: any) => {
          this.noticias.push(element)
        });
      }
    })

  }




  public images: any[] = [
    {
      src: '/assets/Imagem/china2.jpg',
      alt: 'Imagem 1',
      titulo: 'TREM BLINDADO',
      subtitulo: 'Coreia do Norte'
    },
    {
      src: '/assets/Imagem/iguana2.jpg',
      alt: 'Imagem 2',
      titulo: 'Iguana',
      subtitulo: 'Réptil inofensivo que usa 90% de seu tempo para descansar'
    },
  ]

  public noticias1: any[] = [
    {
      src: '/assets/Imagem/china2.jpg',
      alt: 'Imagem 1',
      titulo: 'TESTE',
      sub: 'TESTE'
    },
    {
      src: '/assets/Imagem/china2.jpg',
      alt: 'Imagem 1',
      titulo: 'TESTE',
      sub: 'TESTE'
    },


  ]

  public noticias2: any[] = [
    {
      src: '/assets/Imagem/china2.jpg',
      alt: 'Imagem 1',
      titulo: 'TESTE',
      sub: 'TESTE'
    },

  ]

}
