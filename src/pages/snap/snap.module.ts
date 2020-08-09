import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { SnapPage } from './snap';

@NgModule({
  declarations: [
    SnapPage,
  ],
  imports: [
    IonicPageModule.forChild(SnapPage),
  ],
})
export class SnapPageModule {}
