<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="http://p1jtshf46.bkt.clouddn.com/1514452616" height="100px" >
    </a>
    <h1 align="center">伊一商城项目</h1>
    <br>
</p>

## 1.项目介绍

##### 这是为我未来的女儿做的项目，是一个购物网站，免得以后还要去为马云做贡献

##### 为了更好的方便我会使用git管理代码，这样我可以在任何地方编写和更改我的代码；而且也方便保存，说不定以后我女儿也对编程感兴趣呢，还可以装一波

##### 在这个项目中我会用结合前面的知识，如果有什么不足还请多见谅。



[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-app-advanced/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-app-advanced/downloads.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-advanced.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-advanced)

2.主要功能模块
-------------------

### 2.1 有以下系统：

##### 后台：品牌管理，文章管理，商品分类管理，商品管理
##### 前台：

### 2.2开发环境和技术
##### 开发工具: Phpstorm+PHP5.6+GIT+Apache
##### 相关技术: Yii2.0+CDN+jQuery+sphinx

### 2.3 项目人员组成周期成本

#### 2.3.1项目人员周期成本


职位 | 人数 
---|---
项目经理 | 1
开发人员 | 3 
UI设计 | 0 
前端开发人员 | 1 
测试人员 | 1

#### 2.3.2 周期成本


## 3.系统功能模块

#### 3.1需求

##### 品牌管理：
##### 文章管理：
##### 商品分类管理：
##### 商品管理：

### 3.2流程

### 3.3设计要点

##### 1.前后台设计
##### 2.商品无限极分类设计
##### 3.订单流程设计
##### 4.购物车设计

### 3.4 要点和难点以及解决方案

##### 做项目难免会遇到困难，要将心态放平稳，遇到困难不要慌，一步一步来，总能将解决问题，毛主席说过：只要思想不滑坡，办法总比困难多。

## 4.品牌模块设计

### 4.1 需求
- 品牌管理的列表的增删改查
-  上传图片并保存
-  展示状态为启用的品牌

### 4.2 流程
### 4.3 设计要点及解决方案

1. 为了提升用户体验，在框架中使用upload插件
2. 将图片保存到云空间，下载七牛云插件
3. 将图片上传到七牛云
4. 建立回收站，将未启用的品牌放到回收站中
5. 逻辑删除，在列表展示页中删除，只是将品牌放入回收站中，在回收站中才能输出数据

## 5 文章模块设计

### 5.1 需求
- 文章管理的增删改查
-  文章分类的增删改查
-  文章详情与文章建立1对1关系，文章分类与文章建立1对多关系

### 5.2 流程
### 5.3 设计要点及解决方案

1. 使用富文本编辑器提升用户体验，下载yii Uedit插件
2. hasone 建立一对一关系   hasmany 建立一对多关系

## 6 商品分类模块设计

### 6.1 需求
- 商品分类管理的增删改查
-  设计无限极分类
-  展示列表可以折叠

### 6.2 流程
### 6.3 设计要点及解决方案

1. composer 下载 yii nest 和ztree 插件 设计无限分类
2. composer 下载 treegrid 插件 解决列表折叠功能

## 7 商品模块设计

### 7.1 需求
- 商品管理的增删改查
-  商品列表也可以进行搜索（名称，状态，售价范围）
- 商品详情使用ueditor
- 新增商品自动生成订单

### 7.2 流程
### 7.3 设计要点及解决方案

1.商品详情 下载yii Ueditor插件

2.商品多图上传   单图和多图分别用调用不同的方法上传

3.回显多图
        $imagesFile=GoodsGallery::find()->where($goods_id=$id)->asArray()->all();
        //将处理好的数据赋值给imagesFile
        $model->imagesFile=array_column($imagesFile,'path');
        
4.搜索 使用if语句判断  一定要用andwhere  不能用where 在yii框架内where会覆盖前面的where条件

## 7 登陆模块设计

### 7.1 需求
- 实现用户登陆
- 实现自动登陆
- 密码加密

### 7.2 流程
1.先创建一个用户用于测试

2.创建登陆界面

3.判断用户密码是否正确
### 7.3 设计要点及解决方案


 
 

