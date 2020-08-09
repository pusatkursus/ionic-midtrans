import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { PostProvider } from '../../providers/post-provider';
declare var snap:any;
/**
 * Generated class for the SnapPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-snap',
  templateUrl: 'snap.html',
})
export class SnapPage {

  constructor(
    public navCtrl: NavController, 
    public navParams: NavParams,
    private postPvdr : PostProvider) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad SnapPage');
  }

  bayar(){
    let body={}
    this.postPvdr.postData(body, 'checkout.php').subscribe((data:any) => {
      console.log(data);
      snap.pay(data.token,{
          // Optional
          onSuccess: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onPending: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onError: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        }
      });
    });
  }

}
