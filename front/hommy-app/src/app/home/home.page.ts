import { Component, OnInit } from '@angular/core';

class Republica {
  nome: string;
  endereco: string;
  descricao: string;
  preco: string;
  img: string;
}

@Component({
  selector: 'app-home',
  templateUrl: './home.page.html',
  styleUrls: ['./home.page.scss'],
})

export class HomePage implements OnInit {

  republicas: Republica[];

  constructor() { }

  ngOnInit() {

    this.republicas = [
      {
        img: '../../assets/img/residencia2.jpg',
        nome: 'República 1',
        endereco: 'rua taltal, n 64 - Botafogo, Rio de Janeiro',
        descricao: 'a republica mais antiga de Botafogo agora está a sua disposção',
        preco: '520,99'
      },
      {
        img: '../../assets/img/residencia3.jpg',
        nome: 'República 2',
        endereco: 'rua fulano, n 105 - Copacabana, Rio de Janeiro',
        descricao: 'a republica mais antiga de Copacabana agora está a sua disposção',
        preco: '490,99'
      },
      {
        img: '../../assets/img/residencia1.jpg',
        nome: 'República 3',
        endereco: 'rua creide, n 277 - Urca, Rio de Janeiro',
        descricao: 'a republica mais antiga da Urca agora está a sua disposção',
        preco: '640,99'
      }
    ];
  }
}
