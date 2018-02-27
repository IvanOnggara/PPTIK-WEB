
//tema
				var theme = {
					color: [
						'#26B99A', '#34495E', '#ff5050', '#3498DB',
						'#9B59B6', '#8abb6f', '#759c6a', '#381735',
						'#bfbf20', '#b74826'
					],

					title: {
						itemGap: 8,
						textStyle: {
							fontWeight: 'normal',
							color: '#408829'
						}
					},

					dataRange: {
						color: ['#1f610a', '#97b58d']
					},

					toolbox: {
						color: ['#408829', '#408829', '#408829', '#408829']
					},

					tooltip: {
						backgroundColor: 'rgba(0,0,0,0.5)',
						axisPointer: {
							type: 'line',
							lineStyle: {
								color: '#408829',
								type: 'dashed'
							},
							crossStyle: {
								color: '#408829'
							},
							shadowStyle: {
								color: 'rgba(200,200,200,0.3)'
							}
						}
					},

					dataZoom: {
						dataBackgroundColor: '#eee',
						fillerColor: 'rgba(64,136,41,0.2)',
						handleColor: '#408829'
					},
					grid: {
						borderWidth: 0
					},

					categoryAxis: {
						axisLine: {
							lineStyle: {
								color: '#408829'
							}
						},
						splitLine: {
							lineStyle: {
								color: ['#eee']
							}
						}
					},

					valueAxis: {
						axisLine: {
							lineStyle: {
								color: '#408829'
							}
						},
						splitArea: {
							show: true,
							areaStyle: {
								color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
							}
						},
						splitLine: {
							lineStyle: {
								color: ['#eee']
							}
						}
					},
					timeline: {
						lineStyle: {
							color: '#408829'
						},
						controlStyle: {
							normal: {color: '#408829'},
							emphasis: {color: '#408829'}
						}
					},

					k: {
						itemStyle: {
							normal: {
								color: '#68a54a',
								color0: '#a9cba2',
								lineStyle: {
									width: 1,
									color: '#408829',
									color0: '#86b379'
								}
							}
						}
					},
					map: {
						itemStyle: {
							normal: {
								areaStyle: {
									color: '#ddd'
								},
								label: {
									textStyle: {
										color: '#c12e34'
									}
								}
							},
							emphasis: {
								areaStyle: {
									color: '#99d2dd'
								},
								label: {
									textStyle: {
										color: '#c12e34'
									}
								}
							}
						}
					},
					force: {
						itemStyle: {
							normal: {
								linkStyle: {
									strokeColor: '#408829'
								}
							}
						}
					},
					chord: {
						padding: 4,
						itemStyle: {
							normal: {
								lineStyle: {
									width: 1,
									color: 'rgba(128, 128, 128, 0.5)'
								},
								chordStyle: {
									lineStyle: {
										width: 1,
										color: 'rgba(128, 128, 128, 0.5)'
									}
								}
							},
							emphasis: {
								lineStyle: {
									width: 1,
									color: 'rgba(128, 128, 128, 0.5)'
								},
								chordStyle: {
									lineStyle: {
										width: 1,
										color: 'rgba(128, 128, 128, 0.5)'
									}
								}
							}
						}
					},
					gauge: {
						startAngle: 225,
						endAngle: -45,
						axisLine: {
							show: true,
							lineStyle: {
								color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
								width: 8
							}
						},
						axisTick: {
							splitNumber: 10,
							length: 12,
							lineStyle: {
								color: 'auto'
							}
						},
						axisLabel: {
							textStyle: {
								color: 'auto'
							}
						},
						splitLine: {
							length: 18,
							lineStyle: {
								color: 'auto'
							}
						},
						pointer: {
							length: '90%',
							color: 'auto'
						},
						title: {
							textStyle: {
								color: '#333'
							}
						},
						detail: {
							textStyle: {
								color: 'auto'
							}
						}
					},
					textStyle: {
						fontFamily: 'Arial, Verdana, sans-serif'
					}
				};
//tema






//chart data kelulusan begin
				if ($('#mainmain').length) {
					var e =document.getElementById("periode_");
					var periode = e.options[e.selectedIndex].value;
					var echartBar = echarts.init(document.getElementById('mainmain'), theme);
					var e =document.getElementById("prodi_");
					var textprodi = e.options[e.selectedIndex].text;
					var prodii = e.options[e.selectedIndex].value;

					var e =document.getElementById("semester_");
					var semester = e.options[e.selectedIndex].value;

					$.get('updateinfoadmin?q='+periode+'&p='+prodii+'&s='+semester,function(data){
						var a = data;

						console.log(a);
						echartBar.setOption({
											title: {
												text: 'Periode '+ periode,
												subtext: textprodi
											},
											tooltip: {
												trigger: 'axis'
											},
											legend: {
												data: ['Lulus', 'Tidak Lulus']
											},
											toolbox: {
												show: true,
												feature: {
													saveAsImage: {
														type: "png",
														show: true,
														title: "Save Image",
														name: "Data Kelulusan "+textprodi+" Periode "+periode+" "+semester
													}
												}
												
											},
											calculable: false,
											xAxis: [{
												type: 'category',
												data: ['MTA', 'MOS', 'SCM', 'MTCNA']
											}],
											yAxis: [{
												type: 'value'
											}],
											series: [{
												name: 'Lulus',
												type: 'bar',
												data: [a.mtalulus, a.moslulus, a.scmlulus, a.mtcnalulus],
												markPoint: {
												data: [{
													name: 'MTA',
													value: a.mtalulus,
													xAxis: 0,
													yAxis: a.mtalulus,
												}, {
													name: 'MOS',
													value: a.moslulus,
													xAxis: 1,
													yAxis: a.moslulus
												}, {
													name: 'SCM',
													value: a.scmlulus,
													xAxis: 2,
													yAxis: a.scmlulus
												}, {
													name: 'MTCNA',
													value: a.mtcnalulus,
													xAxis: 3,
													yAxis: a.mtcnalulus
												}]
												}
											}, {
												name: 'Tidak Lulus',
												type: 'bar',
												data: [a.mtatidaklulus, a.mostidaklulus, a.scmtidaklulus, a.mtcnatidaklulus],
												markPoint: {
												data: [{
													name: 'MTA',
													value: a.mtatidaklulus,
													xAxis: 0,
													yAxis: a.mtatidaklulus,
												}, {
													name: 'MOS',
													value: a.mostidaklulus,
													xAxis: 1,
													yAxis: a.mostidaklulus
												}, {
													name: 'SCM',
													value: a.scmtidaklulus,
													xAxis: 2,
													yAxis: a.scmtidaklulus
												}, {
													name: 'MTCNA',
													value: a.mtcnatidaklulus,
													xAxis: 3,
													yAxis: a.mtcnatidaklulus
												}]
												}
											}]
											});
				});

				}
//chart data kelulusan

	


	//echart mta begin
				if ($('#echart_mta').length ){
							var e =document.getElementById("periodemta");
							var periodemta = e.options[e.selectedIndex].value;

							var e =document.getElementById("semestermta");
							var semestermta = e.options[e.selectedIndex].value;

							var echartmta = echarts.init(document.getElementById('echart_mta'), theme);

							$.get('echartmta?q='+periodemta+'&s='+semestermta,function(mtdata){
								var mtadata = mtdata;
								var totalmta = mtadata.if + mtadata.si + mtadata.kim + mtadata.far + mtadata.akun + 
								mtadata.man + mtadata.mandarin + mtadata.sasing + mtadata.ti + mtadata.dkv;

								document.getElementById('total_mta').innerHTML = 'Total : '+totalmta+' Peserta';


									echartmta.setOption({
										tooltip: {
										trigger: 'item',
									formatter: "{a} <br/>{b} : {c} ({d}%)"
								},
								legend: {
									x: 'center',
									y: 'bottom',
									data: ['Teknik Informatika', 'Sistem Informasi', 'Kimia', 'Farmasi', 'Teknik Industri', 
									'DKV', 'Manajemen', 'Akuntansi', 'Mandarin', 'Sastra Inggris']
								},
								toolbox: {
									show: true,
									feature: {
									magicType: {
										show: true,
										type: ['pie', 'funnel'],
										option: {
										funnel: {
											x: '25%',
											width: '50%',
											funnelAlign: 'left',
											max: 1548
										}
										}
									},
									saveAsImage: {
										type: "png",
										show: true,
										title: "Save Image",
										name: "Chart Peserta MTA "+semestermta+" "+periodemta
									}
									}
								},
								calculable: true,
								series: [{
									name: 'Pendaftar MTA',
									type: 'pie',
									radius: '55%',
									center: ['50%', '48%'],
									data: [{
									value: mtadata.if,
									name: 'Teknik Informatika'
									}, {
									value: mtadata.si,
									name: 'Sistem Informasi'
									}, {
									value: mtadata.kim,
									name: 'Kimia'
									}, {
									value: mtadata.far,
									name: 'Farmasi'
									}, {
									value: mtadata.ti,
									name: 'Teknik Industri'
									}, {
									value: mtadata.dkv,
									name: 'DKV'
									}, {
									value: mtadata.man,
									name: 'Manajemen'
									}, {
									value: mtadata.akun,
									name: 'Akuntansi'
									}, {
									value: mtadata.mandarin,
									name: 'Mandarin'
									}, {
									value: mtadata.sasing,
									name: 'Sastra Inggris'
									}]
								}]
								});

								var dataStyle = {
								normal: {
									label: {
									show: false
									},
									labelLine: {
									show: false
									}
								}
								};

								var placeHolderStyle = {
								normal: {
									color: 'rgba(0,0,0,0)',
									label: {
									show: false
									},
									labelLine: {
									show: false
									}
								},
								emphasis: {
									color: 'rgba(0,0,0,0)'
								}
							};
					});

				}
//echart mta




//echart_mos begin
			if ($('#echart_mos').length ){
					var e =document.getElementById("periodemos");
					var periodemos = e.options[e.selectedIndex].value;

					var e =document.getElementById("semestermos");
					var semestermos = e.options[e.selectedIndex].value;
					var echartmos = echarts.init(document.getElementById('echart_mos'), theme);

					$.get('echartmos?q='+periodemos+'&s='+semestermos,function(mosdata){
					var modata = mosdata;
					var totalmos = modata.if + modata.si + modata.kim + modata.far + modata.akun + 
								modata.man + modata.mandarin + modata.sasing + modata.ti + modata.dkv;
								
								document.getElementById('total_mos').innerHTML = 'Total : '+totalmos+' Peserta';

					echartmos.setOption({
					tooltip: {
						trigger: 'item',
						formatter: "{a} <br/>{b} : {c} ({d}%)"
					},
					legend: {
						x: 'center',
						y: 'bottom',
						data: ['Teknik Informatika', 'Sistem Informasi', 'Kimia', 'Farmasi', 'Teknik Industri', 
						'DKV', 'Manajemen', 'Akuntansi', 'Mandarin', 'Sastra Inggris']
					},
					toolbox: {
						show: true,
						feature: {
						magicType: {
							show: true,
							type: ['pie', 'funnel'],
							option: {
							funnel: {
								x: '25%',
								width: '50%',
								funnelAlign: 'left',
								max: 1548
							}
							}
						},
						saveAsImage: {
							type: "png",
							show: true,
							title: "Save Image",
							name: "Chart Peserta MOS "+semestermos+" "+periodemos
						}
						}
					},
					calculable: true,
					series: [{
						name: 'Pendaftar MOS',
						type: 'pie',
						radius: '55%',
						center: ['50%', '48%'],
						data: [{
						value: modata.if,
						name: 'Teknik Informatika'
						}, {
						value: modata.si,
						name: 'Sistem Informasi'
						}, {
						value: modata.kim,
						name: 'Kimia'
						}, {
						value: modata.far,
						name: 'Farmasi'
						}, {
						value: modata.ti,
						name: 'Teknik Industri'
						}, {
						value: modata.dkv,
						name: 'DKV'
						}, {
						value: modata.man,
						name: 'Manajemen'
						}, {
						value: modata.akun,
						name: 'Akuntansi'
						}, {
						value: modata.mandarin,
						name: 'Mandarin'
						}, {
						value: modata.sasing,
						name: 'Sastra Inggris'
						}]
					}]
					});

					var dataStyle = {
					normal: {
						label: {
						show: false
						},
						labelLine: {
						show: false
						}
					}
					};

					var placeHolderStyle = {
					normal: {
						color: 'rgba(0,0,0,0)',
						label: {
						show: false
						},
						labelLine: {
						show: false
						}
					},
					emphasis: {
						color: 'rgba(0,0,0,0)'
					}
					};
				});

			}
//echart_mos 





//echart_scm begin
			if ($('#echart_scm').length ){ 

					var e =document.getElementById("periodescm");
					var periodescm = e.options[e.selectedIndex].value;

					var e =document.getElementById("semesterscm");
					var semesterscm = e.options[e.selectedIndex].value;
					var echartscm = echarts.init(document.getElementById('echart_scm'), theme);

					$.get('echartscm?q='+periodescm+'&s='+semesterscm,function(scmdata){
					var scdata = scmdata;
					var totalscm = scdata.if + scdata.si + scdata.kim + scdata.far + scdata.akun + 
								scdata.man + scdata.mandarin + scdata.sasing + scdata.ti + scdata.dkv;
								
								document.getElementById('total_scm').innerHTML = 'Total : '+totalscm+' Peserta';

					echartscm.setOption({
					tooltip: {
						trigger: 'item',
						formatter: "{a} <br/>{b} : {c} ({d}%)"
					},
					legend: {
						x: 'center',
						y: 'bottom',
						data: ['Teknik Informatika', 'Sistem Informasi', 'Kimia', 'Farmasi', 'Teknik Industri', 
						'DKV', 'Manajemen', 'Akuntansi', 'Mandarin', 'Sastra Inggris']
					},
					toolbox: {
						show: true,
						feature: {
						magicType: {
							show: true,
							type: ['pie', 'funnel'],
							option: {
							funnel: {
								x: '25%',
								width: '50%',
								funnelAlign: 'left',
								max: 1548
							}
							}
						},
						saveAsImage: {
							type: "png",
							show: true,
							title: "Save Image",
							name: "Chart Peserta SCM "+semesterscm+" "+periodescm
						}
						}
					},
					calculable: true,
					series: [{
						name: 'Pendaftar SCM',
						type: 'pie',
						radius: '55%',
						center: ['50%', '48%'],
						data: [{
						value: scdata.if,
						name: 'Teknik Informatika'
						}, {
						value: scdata.si,
						name: 'Sistem Informasi'
						}, {
						value: scdata.kim,
						name: 'Kimia'
						}, {
						value: scdata.far,
						name: 'Farmasi'
						}, {
						value:scdata.ti ,
						name: 'Teknik Industri'
						}, {
						value: scdata.dkv,
						name: 'DKV'
						}, {
						value: scdata.man,
						name: 'Manajemen'
						}, {
						value: scdata.akun,
						name: 'Akuntansi'
						}, {
						value: scdata.mandarin,
						name: 'Mandarin'
						}, {
						value: scdata.sasing,
						name: 'Sastra Inggris'
						}]
					}]
					});

					var dataStyle = {
					normal: {
						label: {
						show: false
						},
						labelLine: {
						show: false
						}
					}
					};

					var placeHolderStyle = {
					normal: {
						color: 'rgba(0,0,0,0)',
						label: {
						show: false
						},
						labelLine: {
						show: false
						}
					},
					emphasis: {
						color: 'rgba(0,0,0,0)'
					}
					};
				});
			}
//echart_scm


//echart_mtcna begin
			if ($('#echart_mtcna').length ){ 

					
					var e =document.getElementById("periodemtcna");
					var periodemtcna = e.options[e.selectedIndex].value;

					var e =document.getElementById("semestermtcna");
					var semestermtcna = e.options[e.selectedIndex].value;
					var echartmtcna = echarts.init(document.getElementById('echart_mtcna'), theme);

					$.get('echartmtcna?q='+periodemtcna+'&s='+semestermtcna,function(mtcnadata){
					var mtcdata = mtcnadata;
					var totalmtcna = 0;
					var totalmtcna = mtcdata.if + mtcdata.si + mtcdata.kim + mtcdata.far + mtcdata.akun + 
								mtcdata.man + mtcdata.mandarin + mtcdata.sasing + mtcdata.ti + mtcdata.dkv;
								
					document.getElementById('total_mtcna').innerHTML = 'Total : '+totalmtcna+' Peserta';

					echartmtcna.setOption({
					tooltip: {
						trigger: 'item',
						formatter: "{a} <br/>{b} : {c} ({d}%)"
					},
					legend: {
						x: 'center',
						y: 'bottom',
						data: ['Teknik Informatika', 'Sistem Informasi', 'Kimia', 'Farmasi', 'Teknik Industri', 
						'DKV', 'Manajemen', 'Akuntansi', 'Mandarin', 'Sastra Inggris']
					},
					toolbox: {
						show: true,
						feature: {
						magicType: {
							show: true,
							type: ['pie', 'funnel'],
							option: {
							funnel: {
								x: '25%',
								width: '50%',
								funnelAlign: 'left',
								max: 1548
							}
							}
						},
						saveAsImage: {
							type: "png",
							show: true,
							title: "Save Image",
							name: "Chart Peserta MTCNA "+semestermtcna+" "+periodemtcna
						}
						}
					},
					calculable: true,
					series: [{
						name: 'Pendaftar MTCNA',
						type: 'pie',
						radius: '55%',
						center: ['50%', '48%'],
						data: [{
						value: mtcdata.if,
						name: 'Teknik Informatika'
						}, {
						value: mtcdata.si,
						name: 'Sistem Informasi'
						}, {
						value: mtcdata.kim,
						name: 'Kimia'
						}, {
						value: mtcdata.far,
						name: 'Farmasi'
						}, {
						value: mtcdata.ti,
						name: 'Teknik Industri'
						}, {
						value: mtcdata.dkv,
						name: 'DKV'
						}, {
						value: mtcdata.man,
						name: 'Manajemen'
						}, {
						value: mtcdata.akun,
						name: 'Akuntansi'
						}, {
						value: mtcdata.mandarin,
						name: 'Mandarin'
						}, {
						value: mtcdata.sasing,
						name: 'Sastra Inggris'
						}]
					}]
					});

					var dataStyle = {
					normal: {
						label: {
						show: false
						},
						labelLine: {
						show: false
						}
					}
					};

					var placeHolderStyle = {
					normal: {
						color: 'rgba(0,0,0,0)',
						label: {
						show: false
						},
						labelLine: {
						show: false
						}
					},
					emphasis: {
						color: 'rgba(0,0,0,0)'
					}
					};
				});

			}

//echart_mtcna






		function updatePeriode() {

				var e =document.getElementById("prodi_");
				var prodi = e.options[e.selectedIndex].value;
				var textprodi = e.options[e.selectedIndex].text;

				var e =document.getElementById("periode_");
				var periode = e.options[e.selectedIndex].value;

				var e =document.getElementById("semester_");
					var semester = e.options[e.selectedIndex].value;
				
				$.get('updateinfoadmin?q='+periode+'&p='+prodi+'&s='+semester,function(data){
					var a = data;

					console.log(a);
					echartBar.setOption({
											title: {
												text: 'Periode '+ periode,
												subtext: textprodi
											},
											tooltip: {
												trigger: 'axis'
											},
											legend: {
												data: ['Lulus', 'Tidak Lulus']
											},
											toolbox: {
												show: true,
												feature: {
													saveAsImage: {
														type: "png",
														show: true,
														title: "Save Image",
														name: "Data Kelulusan "+textprodi+" Periode "+periode+" "+semester
													}
												}
											},
											calculable: false,
											xAxis: [{
												type: 'category',
												data: ['MTA', 'MOS', 'SCM', 'MTCNA']
											}],
											yAxis: [{
												type: 'value'
											}],
											series: [{
												name: 'Lulus',
												type: 'bar',
												data: [a.mtalulus, a.moslulus, a.scmlulus, a.mtcnalulus],
												markPoint: {
												data: [{
													name: 'MTA',
													value: a.mtalulus,
													xAxis: 0,
													yAxis: a.mtalulus,
												}, {
													name: 'MOS',
													value: a.moslulus,
													xAxis: 1,
													yAxis: a.moslulus
												}, {
													name: 'SCM',
													value: a.scmlulus,
													xAxis: 2,
													yAxis: a.scmlulus
												}, {
													name: 'MTCNA',
													value: a.mtcnalulus,
													xAxis: 3,
													yAxis: a.mtcnalulus
												}]
												}
											}, {
												name: 'Tidak Lulus',
												type: 'bar',
												data: [a.mtatidaklulus, a.mostidaklulus, a.scmtidaklulus, a.mtcnatidaklulus],
												markPoint: {
												data: [{
													name: 'MTA',
													value: a.mtatidaklulus,
													xAxis: 0,
													yAxis: a.mtatidaklulus,
												}, {
													name: 'MOS',
													value: a.mostidaklulus,
													xAxis: 1,
													yAxis: a.mostidaklulus
												}, {
													name: 'SCM',
													value: a.scmtidaklulus,
													xAxis: 2,
													yAxis: a.scmtidaklulus
												}, {
													name: 'MTCNA',
													value: a.mtcnatidaklulus,
													xAxis: 3,
													yAxis: a.mtcnatidaklulus
												}]
												}
											}]
											});
				});
		}

		function datapesertamta(){
							var e =document.getElementById("periodemta");
							var periodemta = e.options[e.selectedIndex].value;

							var e =document.getElementById("semestermta");
							var semestermta = e.options[e.selectedIndex].value;

							var echartmta = echarts.init(document.getElementById('echart_mta'), theme);

							$.get('echartmta?q='+periodemta+'&s='+semestermta,function(mtdata){
								var mtadata = mtdata;
								var totalmta = 0;
								var totalmta = mtadata.if + mtadata.si + mtadata.kim + mtadata.far + mtadata.akun + 
								mtadata.man + mtadata.mandarin + mtadata.sasing + mtadata.ti + mtadata.dkv;

								document.getElementById('total_mta').innerHTML = 'Total : '+totalmta+' Peserta';

									echartmta.setOption({
										tooltip: {
										trigger: 'item',
									formatter: "{a} <br/>{b} : {c} ({d}%)"
								},
								legend: {
									x: 'center',
									y: 'bottom',
									data: ['Teknik Informatika', 'Sistem Informasi', 'Kimia', 'Farmasi', 'Teknik Industri', 
									'DKV', 'Manajemen', 'Akuntansi', 'Mandarin', 'Sastra Inggris']
								},
								toolbox: {
									show: true,
									feature: {
									magicType: {
										show: true,
										type: ['pie', 'funnel'],
										option: {
										funnel: {
											x: '25%',
											width: '50%',
											funnelAlign: 'left',
											max: 1548
										}
										}
									},
									saveAsImage: {
										type: "png",
										show: true,
										title: "Save Image",
										name: "Chart Peserta MTA "+semestermta+" "+periodemta
									}
									}
								},
								calculable: true,
								series: [{
									name: 'Pendaftar MTA',
									type: 'pie',
									radius: '55%',
									center: ['50%', '48%'],
									data: [{
									value: mtadata.if,
									name: 'Teknik Informatika'
									}, {
									value: mtadata.si,
									name: 'Sistem Informasi'
									}, {
									value: mtadata.kim,
									name: 'Kimia'
									}, {
									value: mtadata.far,
									name: 'Farmasi'
									}, {
									value: mtadata.ti,
									name: 'Teknik Industri'
									}, {
									value: mtadata.dkv,
									name: 'DKV'
									}, {
									value: mtadata.man,
									name: 'Manajemen'
									}, {
									value: mtadata.akun,
									name: 'Akuntansi'
									}, {
									value: mtadata.mandarin,
									name: 'Mandarin'
									}, {
									value: mtadata.sasing,
									name: 'Sastra Inggris'
									}]
								}]
								});

								var dataStyle = {
								normal: {
									label: {
									show: false
									},
									labelLine: {
									show: false
									}
								}
								};

								var placeHolderStyle = {
								normal: {
									color: 'rgba(0,0,0,0)',
									label: {
									show: false
									},
									labelLine: {
									show: false
									}
								},
								emphasis: {
									color: 'rgba(0,0,0,0)'
								}
							};
					});

		}

		function datapesertamos(){
			var e =document.getElementById("periodemos");
					var periodemos = e.options[e.selectedIndex].value;

					var e =document.getElementById("semestermos");
					var semestermos = e.options[e.selectedIndex].value;
					var echartmos = echarts.init(document.getElementById('echart_mos'), theme);

					$.get('echartmos?q='+periodemos+'&s='+semestermos,function(mosdata){
					var modata = mosdata;
					var totalmos = 0;
					var totalmos = modata.if + modata.si + modata.kim + modata.far + modata.akun + 
								modata.man + modata.mandarin + modata.sasing + modata.ti + modata.dkv;
								
								document.getElementById('total_mos').innerHTML = 'Total : '+totalmos+' Peserta';
					echartmos.setOption({
					tooltip: {
						trigger: 'item',
						formatter: "{a} <br/>{b} : {c} ({d}%)"
					},
					legend: {
						x: 'center',
						y: 'bottom',
						data: ['Teknik Informatika', 'Sistem Informasi', 'Kimia', 'Farmasi', 'Teknik Industri', 
						'DKV', 'Manajemen', 'Akuntansi', 'Mandarin', 'Sastra Inggris']
					},
					toolbox: {
						show: true,
						feature: {
						magicType: {
							show: true,
							type: ['pie', 'funnel'],
							option: {
							funnel: {
								x: '25%',
								width: '50%',
								funnelAlign: 'left',
								max: 1548
							}
							}
						},
						saveAsImage: {
							type: "png",
							show: true,
							title: "Save Image",
							name: "Chart Peserta MOS "+semestermos+" "+periodemos
						}
						}
					},
					calculable: true,
					series: [{
						name: 'Pendaftar MOS',
						type: 'pie',
						radius: '55%',
						center: ['50%', '48%'],
						data: [{
						value: modata.if,
						name: 'Teknik Informatika'
						}, {
						value: modata.si,
						name: 'Sistem Informasi'
						}, {
						value: modata.kim,
						name: 'Kimia'
						}, {
						value: modata.far,
						name: 'Farmasi'
						}, {
						value: modata.ti,
						name: 'Teknik Industri'
						}, {
						value: modata.dkv,
						name: 'DKV'
						}, {
						value: modata.man,
						name: 'Manajemen'
						}, {
						value: modata.akun,
						name: 'Akuntansi'
						}, {
						value: modata.mandarin,
						name: 'Mandarin'
						}, {
						value: modata.sasing,
						name: 'Sastra Inggris'
						}]
					}]
					});

					var dataStyle = {
					normal: {
						label: {
						show: false
						},
						labelLine: {
						show: false
						}
					}
					};

					var placeHolderStyle = {
					normal: {
						color: 'rgba(0,0,0,0)',
						label: {
						show: false
						},
						labelLine: {
						show: false
						}
					},
					emphasis: {
						color: 'rgba(0,0,0,0)'
					}
					};
				});
		}

		function datapesertascm(){
			var e =document.getElementById("periodescm");
					var periodescm = e.options[e.selectedIndex].value;

					var e =document.getElementById("semesterscm");
					var semesterscm = e.options[e.selectedIndex].value;
					var echartscm = echarts.init(document.getElementById('echart_scm'), theme);

					$.get('echartscm?q='+periodescm+'&s='+semesterscm,function(scmdata){
					var scdata = scmdata;
					var totalscm = 0;
							var totalscm = scdata.if + scdata.si + scdata.kim + scdata.far + scdata.akun + 
					scdata.man + scdata.mandarin + scdata.sasing + scdata.ti + scdata.dkv;
					
					document.getElementById('total_scm').innerHTML = 'Total : '+totalscm+' Peserta';

					echartscm.setOption({
					tooltip: {
						trigger: 'item',
						formatter: "{a} <br/>{b} : {c} ({d}%)"
					},
					legend: {
						x: 'center',
						y: 'bottom',
						data: ['Teknik Informatika', 'Sistem Informasi', 'Kimia', 'Farmasi', 'Teknik Industri', 
						'DKV', 'Manajemen', 'Akuntansi', 'Mandarin', 'Sastra Inggris']
					},
					toolbox: {
						show: true,
						feature: {
						magicType: {
							show: true,
							type: ['pie', 'funnel'],
							option: {
							funnel: {
								x: '25%',
								width: '50%',
								funnelAlign: 'left',
								max: 1548
							}
							}
						},
						saveAsImage: {
							type: "png",
							show: true,
							title: "Save Image",
							name: "Chart Peserta SCM "+semesterscm+" "+periodescm
						}
						}
					},
					calculable: true,
					series: [{
						name: 'Pendaftar SCM',
						type: 'pie',
						radius: '55%',
						center: ['50%', '48%'],
						data: [{
						value: scdata.if,
						name: 'Teknik Informatika'
						}, {
						value: scdata.si,
						name: 'Sistem Informasi'
						}, {
						value: scdata.kim,
						name: 'Kimia'
						}, {
						value: scdata.far,
						name: 'Farmasi'
						}, {
						value:scdata.ti ,
						name: 'Teknik Industri'
						}, {
						value: scdata.dkv,
						name: 'DKV'
						}, {
						value: scdata.man,
						name: 'Manajemen'
						}, {
						value: scdata.akun,
						name: 'Akuntansi'
						}, {
						value: scdata.mandarin,
						name: 'Mandarin'
						}, {
						value: scdata.sasing,
						name: 'Sastra Inggris'
						}]
					}]
					});

					var dataStyle = {
					normal: {
						label: {
						show: false
						},
						labelLine: {
						show: false
						}
					}
					};

					var placeHolderStyle = {
					normal: {
						color: 'rgba(0,0,0,0)',
						label: {
						show: false
						},
						labelLine: {
						show: false
						}
					},
					emphasis: {
						color: 'rgba(0,0,0,0)'
					}
					};
				});
		}

		function datapesertamtcna(){
			var e =document.getElementById("periodemtcna");
					var periodemtcna = e.options[e.selectedIndex].value;

					var e =document.getElementById("semestermtcna");
					var semestermtcna = e.options[e.selectedIndex].value;
					var echartmtcna = echarts.init(document.getElementById('echart_mtcna'), theme);

					$.get('echartmtcna?q='+periodemtcna+'&s='+semestermtcna,function(mtcnadata){
					var mtcdata = mtcnadata;
					var totalmtcna = 0;
					var totalmtcna = mtcdata.if + mtcdata.si + mtcdata.kim + mtcdata.far + mtcdata.akun + 
								mtcdata.man + mtcdata.mandarin + mtcdata.sasing + mtcdata.ti + mtcdata.dkv;
								
					document.getElementById('total_mtcna').innerHTML = 'Total : '+totalmtcna+' Peserta';

					echartmtcna.setOption({
					tooltip: {
						trigger: 'item',
						formatter: "{a} <br/>{b} : {c} ({d}%)"
					},
					legend: {
						x: 'center',
						y: 'bottom',
						data: ['Teknik Informatika', 'Sistem Informasi', 'Kimia', 'Farmasi', 'Teknik Industri', 
						'DKV', 'Manajemen', 'Akuntansi', 'Mandarin', 'Sastra Inggris']
					},
					toolbox: {
						show: true,
						feature: {
						magicType: {
							show: true,
							type: ['pie', 'funnel'],
							option: {
							funnel: {
								x: '25%',
								width: '50%',
								funnelAlign: 'left',
								max: 1548
							}
							}
						},
						saveAsImage: {
							type: "png",
							show: true,
							title: "Save Image",
							name: "Chart Peserta MTCNA "+semestermtcna+" "+periodemtcna
						}
						}
					},
					calculable: true,
					series: [{
						name: 'Pendaftar MTCNA',
						type: 'pie',
						radius: '55%',
						center: ['50%', '48%'],
						data: [{
						value: mtcdata.if,
						name: 'Teknik Informatika'
						}, {
						value: mtcdata.si,
						name: 'Sistem Informasi'
						}, {
						value: mtcdata.kim,
						name: 'Kimia'
						}, {
						value: mtcdata.far,
						name: 'Farmasi'
						}, {
						value: mtcdata.ti,
						name: 'Teknik Industri'
						}, {
						value: mtcdata.dkv,
						name: 'DKV'
						}, {
						value: mtcdata.man,
						name: 'Manajemen'
						}, {
						value: mtcdata.akun,
						name: 'Akuntansi'
						}, {
						value: mtcdata.mandarin,
						name: 'Mandarin'
						}, {
						value: mtcdata.sasing,
						name: 'Sastra Inggris'
						}]
					}]
					});

					var dataStyle = {
					normal: {
						label: {
						show: false
						},
						labelLine: {
						show: false
						}
					}
					};

					var placeHolderStyle = {
					normal: {
						color: 'rgba(0,0,0,0)',
						label: {
						show: false
						},
						labelLine: {
						show: false
						}
					},
					emphasis: {
						color: 'rgba(0,0,0,0)'
					}
					};
				});
		}

					