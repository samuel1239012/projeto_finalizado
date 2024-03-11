import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { TopoComponent } from './topo/topo.component';
import { RodapeComponent } from './rodape/rodape.component';
import { HomeComponent } from './home/home.component';
import { ContatoComponent } from './contato/contato.component';
import { QuemSomosComponent } from './quem-somos/quem-somos.component';
import { ContComponent } from './cont/cont.component';
import { CadastreSeComponent } from './cadastre-se/cadastre-se.component';
import { NgxMaskDirective, NgxMaskPipe, provideNgxMask } from 'ngx-mask';
import {HttpClientModule} from '@angular/common/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { AutomoveisComponent } from './automoveis/automoveis.component';
import { PoliticaComponent } from './politica/politica.component';
import { NoticiaComponent } from './noticia/noticia.component';
import { EsporteComponent } from './esporte/esporte.component';
import { EmAltaComponent } from './em-alta/em-alta.component';
import { ServicosComponent } from './servicos/servicos.component';
import { LoginComponent } from './login/login.component';
import { ServicesService } from './service.service';


@NgModule({
  declarations: [
    AppComponent,
    TopoComponent,
    RodapeComponent,
    HomeComponent,
    ContatoComponent,
    QuemSomosComponent,
    ContComponent,
    AutomoveisComponent,
    PoliticaComponent,
    NoticiaComponent,
    EsporteComponent,
    EmAltaComponent,
    CadastreSeComponent,
    LoginComponent,
    
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    NgbModule,
    NgxMaskDirective,
    NgxMaskPipe,
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule
  ],
  providers: [
    provideNgxMask(),
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
