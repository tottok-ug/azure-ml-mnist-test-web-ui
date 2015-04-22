Azure Machine Learning - ハンズオン MNISTで手書き文字認識
=============

## 機械学習とは


## MNISTデータセットとは
国立標準技術研究所の混合データ セット (MNIST データ セット) は、さまざまな IR アルゴリズムを比較する際のベンチマークとして機能させるように、IR の研究者によって作成されました。基本的な考え方としては、テストする IR アルゴリズムまたはソフトウェア システムがある場合、MNIST データ セットに対してアルゴリズムまたはシステムを実行し、他のシステムについて以前発行された結果と比較します。

データ セットには計 70,000 枚の画像が含まれており、そのうち 60,000 枚は学習用画像 (IR モデルの作成に使用) で 10,000 枚は判別用画像 (モデルの精度の評価に使用) です。各 MNIST 画像は、1 つの手書き数字をデジタル化したものです。サイズはそれぞれ 28 x 28 ピクセルです。各ピクセル値は 0 (白) ～ 255 (黒) の値で、中間のピクセル値は灰色の網かけを表します。図 2 に示すのは、学習用セットの最初の画像 8 枚です。各画像に対応した実際の数値を識別するのは、人間には簡単ですが、コンピューターにとっては至難の業です。

## Azure Machine Learningとは






## 使い方
### Azure Machine Learningの使い方

#### WORKSPACEの作成

https://account.windowsazure.com
に接続しログイン

![login](README.img/azureml-login.png)

右上の「ポータル」を選択

![portal](README.img/azureml-portal.png)

「MACHINE LEARNING」を選択後、左下の「新規」から「簡易作成」

![mlnew](README.img/azureml-mlnew.png)

「ワークスペース名」と「ストレージアカウント名」を記入し、「MLワークスペースの作成」

![Workspaceの作成](README.img/azureml-ws.png)

作成した「MACHINE LEARNING」を選択し、
「自分のワークスペースにアクセス」の「ML Studio にサインイン」を選択

![mlssign](README.img/azureml-mlssign.png)


#### Experimentsの作成

左下の「NEW」から「Blank Experiment」を選択

![blank](README.img/azureml-blank.png)
 
#### 機械学習のモデルを作成する。

Saved Datasets / MNIST Train 60k 28x28 dense をドラッグ＆ドロップ

![60000](README.img/azureml-60000.png)

Machine Learning / Train / Train Model をドラッグ＆ドロップ

![train](README.img/azureml-train.png)

MNIST Train 60k 28x28 denseの下の点とTrain Modelの右上を線でつなげる

![60k-train](README.img/azureml-60k-train.png)

Machine Learning / Initialize Model / Classification / の

+ Multiclass Decision Forest
+ Multiclass Decision Jungle
+ Multiclass Logistic Regression
+ Multiclass Neural Network
 
上記4つの中から好きな物を選んでドラッグ＆ドロップ
Multiclass〜の下の点とTrain Modelの左上を線でつなげる

![60k-train](README.img/azureml-multi.png)

Train Modelをクリックし、右に出た「Launch column selector」を選択

![](README.img/)

空欄のところをクリックすると一番上に「Label」があるのでこれを選択

![](README.img/)

Machine Learning / Initialize Model / Score / Score Model をドラッグ＆ドロップ
Train Modelの下の点とScore Modelの左上を線でつなげる
  // TODO 図が欲しい

Saved Datasets / MNIST Test 10k 28x28 dense をドラッグ＆ドロップ
MNIST Test 10k 28x28 denseの下の点とScore Modelの右上を線でつなげる
  // TODO 図が欲しい

Machine Learning / Evaluate / Evaluate Model をドラッグ＆ドロップ
Score Modelの下の点とEvaluate Modelの上の点どちらかを線でつなげる
  // TODO 図が欲しい

下の「RUN」ボタンをクリック
RUNが終了したら（Evaluate Modelまでチェックマークがついたら）Evaluate Modelの下の点をクリック
Visualizeを選択すると結果が表示される
  // TODO 図が欲しい

#### Web APIとして公開する準備

Web Service / Input と
Web Service / Output をドラッグ＆ドロップ
  // TODO 図が欲しい
Inputの下の点とScore Modelの右上を線でつなげる
Outputの上の点とScore Modelの下を線でつなげる
  // TODO 図が欲しい


下の「PUBLISH WEB SERVICE」ボタンをクリックし、YESを選択
![publish web service button](README.img/azureml-publish-webservice-button.png)

![publish!](README.img/azureml-publish.png)

### Web API
 Public web Serviceボタンをクリックすると、下のような画面が開きます。
![Webservice Dashboard](README.img/azureml-webservice-dashboard.png)

 	
この画面では、今作成したWeb APIの仕様を確認したり、テストしたりすることができます。

![ドキュメントのリンク](README.img/azureml-documentlink.png)
  
 APIの仕様を確認すると、どのようなエンドポイントにアクセスし、
 どのようなパラメータがあり、どのようなレスポンスが帰ってくるのかを確認する事ができます。


 
 もし自分のアプリケーションに機械学習の機能を取り込むのであれば、このドキュメントを見ることになります。
 
 ドキュメントの最後には、R, Python, C#でのサンプルコードも載っているので、参考にすることができます。
 
#### Web APIのテスト
WebAPIのテストもブラウザから簡単に行う事ができます。
	
![テストダイアログ](README.img/azureml-test-form.png)
このリンクをクリックする事で、テスト用のフォームが開きます。
	
入力として必要な項目を入力し、チェックマークをクリックすると、APIに問い合わせをします。
 	
 	

### MNIST 確認用フォームの使い方





#### 使い方

![AzureML MNIST 確認フォーム](README.img/azureml-mnist-form.png)
このようなページが開きます。

AzureMLのWeb Serviceから、POST先のURLととAPI KEYを入手します。

- API Key
![API Key](README.img/azureml-apikey.png)
- エンドポイント
![エンドポイント](README.img/azureml-endpoint.png)


![Azure ML Web API の情報入力](README.img/azureml-APIInfomation.png)
↑の二箇所に入れる



---

## MNIST 確認フォームのインストール
#### インストール
新しく仮想マシンを立ち上げ、SSHでログイン

```sh
$ sudo yum -y install httpd php php-mbstring php-gd git 
$ git clone git@github.com:tottok-ug/azure-ml-mnist-test-web-ui.git
```


PHPの動くWebサーバのドキュメントルートに

public/配下の

+ img/
+ js/
+ css/
+ detect.php
+ index.html
+ upload.php

を入れておく。