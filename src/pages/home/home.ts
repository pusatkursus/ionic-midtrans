import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
import { InAppBrowser } from '@ionic-native/in-app-browser';
import { PostProvider } from '../../providers/post-provider';

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {
  hasil:any=[];
  order_id:any;
  gross_amount:any;
  constructor(
    public navCtrl: NavController,
    private iab: InAppBrowser,
    private postPvdr : PostProvider) {

  }

  prosesBeliMidtrans(){
    let body = {
      order_id:this.order_id,
      gross_amount:this.gross_amount
    }

    this.postPvdr.postData(body, 'veritrans_checkout.php').subscribe((data:any) => {
      console.log(data);
      this.hasil=data;
      this.iab.create(data.redirect_url);
    });
  }
}
