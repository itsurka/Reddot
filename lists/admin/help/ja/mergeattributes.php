<p>属性のマージに対する注意</p>
<p>属性をマージすることは、ユーザの値が同じ状態であることを意味していますが、属する実際の属性は、一つにマージされます。残る属性は、最初の一つになります（ページのlistorderによりそれを参照してください）。</p>
<ul>
<li>同じタイプをもつ属性のみマージできます。</li>
<li>マージするとき、存在していれば最初の属性の値が保持されます。そうでなければ、マージされた属性の値により上書きされます。このことは、両方の属性に値がある場合にデータの消失を引き起こします。</li>
<li>タイプが<i>チェックボックス</i>である属性をマージするとき、属性をマージした結果は、<i>チェックボックスグループ</i>タイプになります。</li>
<li>他の属性にマージされた属性は、マージ後に削除されます。</li>
</ul>
