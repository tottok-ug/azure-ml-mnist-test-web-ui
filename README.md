Azure Machine Learning - MNIST 確認用フォーム
=============

## 機械学習とは


## MNISTデータセットとは
国立標準技術研究所の混合データ セット (MNIST データ セット) は、さまざまな IR アルゴリズムを比較する際のベンチマークとして機能させるように、IR の研究者によって作成されました。基本的な考え方としては、テストする IR アルゴリズムまたはソフトウェア システムがある場合、MNIST データ セットに対してアルゴリズムまたはシステムを実行し、他のシステムについて以前発行された結果と比較します。

データ セットには計 70,000 枚の画像が含まれており、そのうち 60,000 枚は学習用画像 (IR モデルの作成に使用) で 10,000 枚は判別用画像 (モデルの精度の評価に使用) です。各 MNIST 画像は、1 つの手書き数字をデジタル化したものです。サイズはそれぞれ 28 x 28 ピクセルです。各ピクセル値は 0 (白) ～ 255 (黒) の値で、中間のピクセル値は灰色の網かけを表します。図 2 に示すのは、学習用セットの最初の画像 8 枚です。各画像に対応した実際の数値を識別するのは、人間には簡単ですが、コンピューターにとっては至難の業です。

## Azure Machine Learningとは






## 使い方
### Azure Machine Learningの使い方
https://account.windowsazure.com/Home/Index
に接続しログイン
→右上の「ポータル」を選択

「MACHINE LEARNING」を選択後、左下の「新規」から「簡易作成」
「ワークスペース名」と「ストレージアカウント名」を記入し、「MLワークスペースの作成」

「自分のワークスペースにアクセス」の「ML Studio にサインイン」を選択

左下の「NEW」から「Blank Experiment」を選択
Saved Datasets / MNIST Train 60k 28x28 dense をドラッグ＆ドロップ
Machine Learning / Train / Train Model をドラッグ＆ドロップ
MNIST Train 60k 28x28 denseの下の点とTrain Modelの右上を線でつなげる

Machine Learning / Initialize Model / Classification / の
・Multiclass Decision Forest
・Multiclass Decision Jungle
・Multiclass Logistic Regression
・Multiclass Neural Network
上記4つの中から好きな物を選んでドラッグ＆ドロップ
Multiclass〜の下の点とTrain Modelの左上を線でつなげる

Train Modelをクリックし、右に出た「Launch column selector」を選択
空欄のところをクリックすると一番上に「Label」があるのでこれを選択

Machine Learning / Initialize Model / Score / Score Model をドラッグ＆ドロップ
Train Modelの下の点とScore Modelの左上を線でつなげる

Saved Datasets / MNIST Test 10k 28x28 dense をドラッグ＆ドロップ
MNIST Test 10k 28x28 denseの下の点とScore Modelの右上を線でつなげる

Machine Learning / Evaluate / Evaluate Model をドラッグ＆ドロップ
Score Modelの下の点とEvaluate Modelの上の点どちらかを線でつなげる

下の「RUN」ボタンをクリック
RUNが終了したら（Evaluate Modelまでチェックマークがついたら）Evaluate Modelの下の点をクリック
Visualizeを選択すると結果が表示される

Web Service / Input と
Web Service / Output をドラッグ＆ドロップ
Inputの下の点とScore Modelの右上を線でつなげる
Outputの上の点とScore Modelの下を線でつなげる

下の「PUBLISH WEB SERVICE」ボタンをクリックし、YESを選択


### MNIST 確認用フォームの使い方



#### インストール
PHPの動くWebサーバのドキュメントルートに

+ img/
+ js/
+ css/
+ detect.php
+ index.html
+ upload.php

を入れておく。

#### 使い方

![AzureML MNIST 確認フォーム](img/azureml-mnist-form.png)
AzureMLのWeb Serviceから、POST先のURLととAPI KEYを入手して、

![Azure ML Web API の情報入力](img/azureml-APIInfomation.png)
↑の二箇所に入れる

