# ionic3-Payment Gateway midtrans API

download dan ekstrak file<br />
kemudian ketik npm install<br />
jika pada saat install denpendency gagal install plugin maka install secara manual dengan command di bawah ini<br />
plugin yang digunakan http6 dan inapbrowser, jangan copy dollarnya<br />
$ npm i @angular/http<br />
$ ionic cordova plugin add cordova-plugin-inappbrowser<br />
$ npm install --save @ionic-native/in-app-browser@4<br />

Kemudian Folder midtrans pindahkan dan taruh di xampp/htdocs<br/>
Kemudian login ke <a href='https://midtrans.com/'>midtrans</a> dan dapatkan apykey lalu ganti server key di file checkout

#Build Project<br>
-debuk apk
ionic cordova build android<br>
#release apk<br>
$ ionic cordova build android --release<br>
-Pindahkan keytool.jks yang sudah jadi dan zipalign.exe dar folder C:\Users\user\AppData\Local\Android\Sdk\build-tools\29.0.2 ke folder release<br>
$ keytool -genkey -v -keystore midtrans.jks -alias midtrans -keyalg RSA -keysize 2048 -validity 10000<br>
$ jarsigner -verbose -sigalg SHA1withRSA -digestalg SHA1 -keystore "midtrans.jks" "app-release-unsigned.apk" midtrans<br>
$ zipalign -v 4 "app-release-unsigned.apk" midtrans.apk<br>

