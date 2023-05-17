"use strict";						//--strict（厳格）モード」で実行。

!function(o) {						//--ギャラリー要素oを引数にした無名関数。

	const
	syasin = o.querySelectorAll(".base img"),	//--写真部分のIMG要素のリスト。
	thumb = o.querySelectorAll(".gallery img"),	//--サムネイルのリスト。
	goukei = syasin.length,				//--写真の枚数合計。
	ido = function(sel){				//--引数の写真を表示する関数。
		stack = idx;				//--現在のインデックスをスタックに入れる。
		idx = sel;				//--インデックスに引数を入れる。
		syasin[idx].style.zIndex = 2;		//--新しい写真を前面に。
		syasin[stack].style.zIndex = 1;		//--古い写真を後面に。
		syasin[idx].style.opacity = 1;		//--新しい写真を不透明に。
		syasin[stack].style.opacity = 0;	//--古い写真を透明に。
	};
	let
	idx = 0,					//--インデックスを宣言し初期値0を代入。
	stack;						//--スタックを宣言。
	for(let t=0; t < goukei; t++){
		thumb[t].ind = t;			//--サムネイルにindプロパティーを作りインデックスを入れる。
		thumb[t].onclick = function() {		//--サムネイルをクリックしたときの処理。
			if(this.ind != idx)ido(this.ind);
							//--indプロパティーがidxと等しくなければ数値化して引数にしido関数を呼び出す。
		}
	};
	syasin[idx].style.zIndex = 2;			//--最初の写真を前面に。
	syasin[idx].style.opacity = 1;			//--最初の写真を不透明に。

}(document.getElementById("my_gal11"));	