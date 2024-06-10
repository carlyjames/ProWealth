"use strict";(self.webpackChunk_N_E=self.webpackChunk_N_E||[]).push([[7536],{7536:function(__unused_webpack___webpack_module__,__webpack_exports__,__webpack_require__){__webpack_require__.d(__webpack_exports__,{cI:function(){return useForm}});var react__WEBPACK_IMPORTED_MODULE_0__=__webpack_require__(7294),isCheckBoxInput=element=>"checkbox"===element.type,isDateObject=value1=>value1 instanceof Date,isNullOrUndefined=value1=>null==value1;let isObjectType=value1=>"object"==typeof value1;var isObject=value1=>!isNullOrUndefined(value1)&&!Array.isArray(value1)&&isObjectType(value1)&&!isDateObject(value1),getEventValue=event=>isObject(event)&&event.target?isCheckBoxInput(event.target)?event.target.checked:event.target.value:event,getNodeParentName=name=>name.substring(0,name.search(/\.\d+(\.|$)/))||name,isNameInFieldArray=(names,name)=>names.has(getNodeParentName(name)),compact=value1=>Array.isArray(value1)?value1.filter(Boolean):[],isUndefined=val=>void 0===val,get=(obj,path,defaultValue)=>{if(!path||!isObject(obj))return defaultValue;let result=compact(path.split(/[,[\].]+?/)).reduce((result,key)=>isNullOrUndefined(result)?result:result[key],obj);return isUndefined(result)||result===obj?isUndefined(obj[path])?defaultValue:obj[path]:result};let EVENTS={BLUR:"blur",FOCUS_OUT:"focusout",CHANGE:"change"},VALIDATION_MODE={onBlur:"onBlur",onChange:"onChange",onSubmit:"onSubmit",onTouched:"onTouched",all:"all"},INPUT_VALIDATION_RULES={max:"max",min:"min",maxLength:"maxLength",minLength:"minLength",pattern:"pattern",required:"required",validate:"validate"};react__WEBPACK_IMPORTED_MODULE_0__.createContext(null);var getProxyFormState=(formState,control,localProxyFormState,isRoot=!0)=>{let result={defaultValues:control._defaultValues};for(let key in formState)Object.defineProperty(result,key,{get(){let _key=key;return control._proxyFormState[_key]!==VALIDATION_MODE.all&&(control._proxyFormState[_key]=!isRoot||VALIDATION_MODE.all),localProxyFormState&&(localProxyFormState[_key]=!0),formState[_key]}});return result},isEmptyObject=value1=>isObject(value1)&&!Object.keys(value1).length,shouldRenderFormState=(formStateData,_proxyFormState,isRoot)=>{let{name,...formState}=formStateData;return isEmptyObject(formState)||Object.keys(formState).length>=Object.keys(_proxyFormState).length||Object.keys(formState).find(key=>_proxyFormState[key]===(!isRoot||VALIDATION_MODE.all))},convertToArrayPayload=value1=>Array.isArray(value1)?value1:[value1],isString=value1=>"string"==typeof value1,generateWatchOutput=(names,_names,formValues,isGlobal)=>{let isArray=Array.isArray(names);return isString(names)?(isGlobal&&_names.watch.add(names),get(formValues,names)):isArray?names.map(fieldName=>(isGlobal&&_names.watch.add(fieldName),get(formValues,fieldName))):(isGlobal&&(_names.watchAll=!0),formValues)},isFunction=value1=>"function"==typeof value1,objectHasFunction=data=>{for(let key in data)if(isFunction(data[key]))return!0;return!1},appendErrors=(name,validateAllFieldCriteria,errors,type,message)=>validateAllFieldCriteria?{...errors[name],types:{...errors[name]&&errors[name].types?errors[name].types:{},[type]:message||!0}}:{},isKey=value1=>/^\w*$/.test(value1),stringToPath=input=>compact(input.replace(/["|']|\]/g,"").split(/\.|\[/));function set(object,path,value1){let index=-1,tempPath=isKey(path)?[path]:stringToPath(path),length=tempPath.length,lastIndex=length-1;for(;++index<length;){let key=tempPath[index],newValue=value1;if(index!==lastIndex){let objValue=object[key];newValue=isObject(objValue)||Array.isArray(objValue)?objValue:isNaN(+tempPath[index+1])?{}:[]}object[key]=newValue,object=object[key]}return object}let focusFieldBy=(fields,callback,fieldsNames)=>{for(let key of fieldsNames||Object.keys(fields)){let field=get(fields,key);if(field){let{_f,...currentField}=field;if(_f&&callback(_f.name)){if(_f.ref.focus){_f.ref.focus();break}if(_f.refs&&_f.refs[0].focus){_f.refs[0].focus();break}}else isObject(currentField)&&focusFieldBy(currentField,callback)}}};var isWatched=(name,_names,isBlurEvent)=>!isBlurEvent&&(_names.watchAll||_names.watch.has(name)||[..._names.watch].some(watchName=>name.startsWith(watchName)&&/^\.\w+/.test(name.slice(watchName.length)))),updateFieldArrayRootError=(errors,error,name)=>{let fieldArrayErrors=compact(get(errors,name));return set(fieldArrayErrors,"root",error[name]),set(errors,name,fieldArrayErrors),errors},isBoolean=value1=>"boolean"==typeof value1,isFileInput=element=>"file"===element.type,isMessage=value1=>isString(value1)||react__WEBPACK_IMPORTED_MODULE_0__.isValidElement(value1),isRadioInput=element=>"radio"===element.type,isRegex=value1=>value1 instanceof RegExp;let defaultResult={value:!1,isValid:!1},validResult={value:!0,isValid:!0};var getCheckboxValue=options=>{if(Array.isArray(options)){if(options.length>1){let values=options.filter(option=>option&&option.checked&&!option.disabled).map(option=>option.value);return{value:values,isValid:!!values.length}}return options[0].checked&&!options[0].disabled?options[0].attributes&&!isUndefined(options[0].attributes.value)?isUndefined(options[0].value)||""===options[0].value?validResult:{value:options[0].value,isValid:!0}:validResult:defaultResult}return defaultResult};let defaultReturn={isValid:!1,value:null};var getRadioValue=options=>Array.isArray(options)?options.reduce((previous,option)=>option&&option.checked&&!option.disabled?{isValid:!0,value:option.value}:previous,defaultReturn):defaultReturn;function getValidateError(result,ref,type="validate"){if(isMessage(result)||Array.isArray(result)&&result.every(isMessage)||isBoolean(result)&&!result)return{type,message:isMessage(result)?result:"",ref}}var getValueAndMessage=validationData=>isObject(validationData)&&!isRegex(validationData)?validationData:{value:validationData,message:""},validateField=async(field,inputValue,validateAllFieldCriteria,shouldUseNativeValidation,isFieldArray)=>{let{ref,refs,required,maxLength,minLength,min,max,pattern,validate,name,valueAsNumber,mount,disabled}=field._f;if(!mount||disabled)return{};let inputRef=refs?refs[0]:ref,setCustomValidity=message=>{shouldUseNativeValidation&&isString(message)&&(inputRef.setCustomValidity(message),inputRef.reportValidity())},error={},isRadio=isRadioInput(ref),isCheckBox=isCheckBoxInput(ref),isEmpty=(valueAsNumber||isFileInput(ref))&&!ref.value||""===inputValue||Array.isArray(inputValue)&&!inputValue.length,appendErrorsCurry=appendErrors.bind(null,name,validateAllFieldCriteria,error),getMinMaxMessage=(exceedMax,maxLengthMessage,minLengthMessage,maxType=INPUT_VALIDATION_RULES.maxLength,minType=INPUT_VALIDATION_RULES.minLength)=>{let message=exceedMax?maxLengthMessage:minLengthMessage;error[name]={type:exceedMax?maxType:minType,message,ref,...appendErrorsCurry(exceedMax?maxType:minType,message)}};if(isFieldArray?!Array.isArray(inputValue)||!inputValue.length:required&&(!(isRadio||isCheckBox)&&(isEmpty||isNullOrUndefined(inputValue))||isBoolean(inputValue)&&!inputValue||isCheckBox&&!getCheckboxValue(refs).isValid||isRadio&&!getRadioValue(refs).isValid)){let{value:value1,message}=isMessage(required)?{value:!!required,message:required}:getValueAndMessage(required);if(value1&&(error[name]={type:INPUT_VALIDATION_RULES.required,message,ref:inputRef,...appendErrorsCurry(INPUT_VALIDATION_RULES.required,message)},!validateAllFieldCriteria))return setCustomValidity(message),error}if(!isEmpty&&(!isNullOrUndefined(min)||!isNullOrUndefined(max))){let exceedMax,exceedMin;let maxOutput=getValueAndMessage(max),minOutput=getValueAndMessage(min);if(isNullOrUndefined(inputValue)||isNaN(inputValue)){let valueDate=ref.valueAsDate||new Date(inputValue),convertTimeToDate=time=>new Date(new Date().toDateString()+" "+time),isTime="time"==ref.type,isWeek="week"==ref.type;isString(maxOutput.value)&&inputValue&&(exceedMax=isTime?convertTimeToDate(inputValue)>convertTimeToDate(maxOutput.value):isWeek?inputValue>maxOutput.value:valueDate>new Date(maxOutput.value)),isString(minOutput.value)&&inputValue&&(exceedMin=isTime?convertTimeToDate(inputValue)<convertTimeToDate(minOutput.value):isWeek?inputValue<minOutput.value:valueDate<new Date(minOutput.value))}else{let valueNumber=ref.valueAsNumber||(inputValue?+inputValue:inputValue);isNullOrUndefined(maxOutput.value)||(exceedMax=valueNumber>maxOutput.value),isNullOrUndefined(minOutput.value)||(exceedMin=valueNumber<minOutput.value)}if((exceedMax||exceedMin)&&(getMinMaxMessage(!!exceedMax,maxOutput.message,minOutput.message,INPUT_VALIDATION_RULES.max,INPUT_VALIDATION_RULES.min),!validateAllFieldCriteria))return setCustomValidity(error[name].message),error}if((maxLength||minLength)&&!isEmpty&&(isString(inputValue)||isFieldArray&&Array.isArray(inputValue))){let maxLengthOutput=getValueAndMessage(maxLength),minLengthOutput=getValueAndMessage(minLength),exceedMax1=!isNullOrUndefined(maxLengthOutput.value)&&inputValue.length>maxLengthOutput.value,exceedMin1=!isNullOrUndefined(minLengthOutput.value)&&inputValue.length<minLengthOutput.value;if((exceedMax1||exceedMin1)&&(getMinMaxMessage(exceedMax1,maxLengthOutput.message,minLengthOutput.message),!validateAllFieldCriteria))return setCustomValidity(error[name].message),error}if(pattern&&!isEmpty&&isString(inputValue)){let{value:patternValue,message:message1}=getValueAndMessage(pattern);if(isRegex(patternValue)&&!inputValue.match(patternValue)&&(error[name]={type:INPUT_VALIDATION_RULES.pattern,message:message1,ref,...appendErrorsCurry(INPUT_VALIDATION_RULES.pattern,message1)},!validateAllFieldCriteria))return setCustomValidity(message1),error}if(validate){if(isFunction(validate)){let result=await validate(inputValue),validateError=getValidateError(result,inputRef);if(validateError&&(error[name]={...validateError,...appendErrorsCurry(INPUT_VALIDATION_RULES.validate,validateError.message)},!validateAllFieldCriteria))return setCustomValidity(validateError.message),error}else if(isObject(validate)){let validationResult={};for(let key in validate){if(!isEmptyObject(validationResult)&&!validateAllFieldCriteria)break;let validateError1=getValidateError(await validate[key](inputValue),inputRef,key);validateError1&&(validationResult={...validateError1,...appendErrorsCurry(key,validateError1.message)},setCustomValidity(validateError1.message),validateAllFieldCriteria&&(error[name]=validationResult))}if(!isEmptyObject(validationResult)&&(error[name]={ref:inputRef,...validationResult},!validateAllFieldCriteria))return error}}return setCustomValidity(!0),error},isPlainObject=tempObject=>{let prototypeCopy=tempObject.constructor&&tempObject.constructor.prototype;return isObject(prototypeCopy)&&prototypeCopy.hasOwnProperty("isPrototypeOf")},isWeb="undefined"!=typeof window&&void 0!==window.phpElement&&"undefined"!=typeof document;function cloneObject(data){let copy;let isArray=Array.isArray(data);if(data instanceof Date)copy=new Date(data);else if(data instanceof Set)copy=new Set(data);else if(!(!(isWeb&&(data instanceof Blob||data instanceof FileList))&&(isArray||isObject(data))))return data;else if(copy=isArray?[]:{},Array.isArray(data)||isPlainObject(data))for(let key in data)copy[key]=cloneObject(data[key]);else copy=data;return copy}var getValidationModes=mode=>({isOnSubmit:!mode||mode===VALIDATION_MODE.onSubmit,isOnBlur:mode===VALIDATION_MODE.onBlur,isOnChange:mode===VALIDATION_MODE.onChange,isOnAll:mode===VALIDATION_MODE.all,isOnTouch:mode===VALIDATION_MODE.onTouched});function unset(object,path){let previousObjRef;let updatePath=isKey(path)?[path]:stringToPath(path),childObject=1==updatePath.length?object:function(object,updatePath){let length=updatePath.slice(0,-1).length,index=0;for(;index<length;)object=isUndefined(object)?index++:object[updatePath[index++]];return object}(object,updatePath),key=updatePath[updatePath.length-1];childObject&&delete childObject[key];for(let k=0;k<updatePath.slice(0,-1).length;k++){let objectRef,index=-1,currentPaths=updatePath.slice(0,-(k+1)),currentPathsLength=currentPaths.length-1;for(k>0&&(previousObjRef=object);++index<currentPaths.length;){let item=currentPaths[index];objectRef=objectRef?objectRef[item]:object[item],currentPathsLength===index&&(isObject(objectRef)&&isEmptyObject(objectRef)||Array.isArray(objectRef)&&function(obj){for(let key in obj)if(!isUndefined(obj[key]))return!1;return!0}(objectRef))&&(previousObjRef?delete previousObjRef[item]:delete object[item]),previousObjRef=objectRef}}return object}function createSubject(){let _observers=[],next=value1=>{for(let observer of _observers)observer.next(value1)},subscribe=observer=>(_observers.push(observer),{unsubscribe(){_observers=_observers.filter(o=>o!==observer)}}),unsubscribe=()=>{_observers=[]};return{get observers(){return _observers},next,subscribe,unsubscribe}}var isPrimitive=value1=>isNullOrUndefined(value1)||!isObjectType(value1);function deepEqual(object1,object2){if(isPrimitive(object1)||isPrimitive(object2))return object1===object2;if(isDateObject(object1)&&isDateObject(object2))return object1.getTime()===object2.getTime();let keys1=Object.keys(object1),keys2=Object.keys(object2);if(keys1.length!==keys2.length)return!1;for(let key of keys1){let val1=object1[key];if(!keys2.includes(key))return!1;if("ref"!==key){let val2=object2[key];if(isDateObject(val1)&&isDateObject(val2)||isObject(val1)&&isObject(val2)||Array.isArray(val1)&&Array.isArray(val2)?!deepEqual(val1,val2):val1!==val2)return!1}}return!0}var isHTMLElement=value1=>{let owner=value1?value1.ownerDocument:0,ElementClass=owner&&owner.defaultView?owner.defaultView.phpElement:HTMLElement;return value1 instanceof ElementClass},isMultipleSelect=element=>"select-multiple"===element.type,isRadioOrCheckbox=ref=>isRadioInput(ref)||isCheckBoxInput(ref),live=ref=>isHTMLElement(ref)&&ref.isConnected;function markFieldsDirty(data,fields={}){let isParentNodeArray=Array.isArray(data);if(isObject(data)||isParentNodeArray)for(let key in data)Array.isArray(data[key])||isObject(data[key])&&!objectHasFunction(data[key])?(fields[key]=Array.isArray(data[key])?[]:{},markFieldsDirty(data[key],fields[key])):isNullOrUndefined(data[key])||(fields[key]=!0);return fields}var getDirtyFields=(defaultValues,formValues)=>(function getDirtyFieldsFromDefaultValues(data,formValues,dirtyFieldsFromValues){let isParentNodeArray=Array.isArray(data);if(isObject(data)||isParentNodeArray)for(let key in data)Array.isArray(data[key])||isObject(data[key])&&!objectHasFunction(data[key])?isUndefined(formValues)||isPrimitive(dirtyFieldsFromValues[key])?dirtyFieldsFromValues[key]=Array.isArray(data[key])?markFieldsDirty(data[key],[]):{...markFieldsDirty(data[key])}:getDirtyFieldsFromDefaultValues(data[key],isNullOrUndefined(formValues)?{}:formValues[key],dirtyFieldsFromValues[key]):deepEqual(data[key],formValues[key])?delete dirtyFieldsFromValues[key]:dirtyFieldsFromValues[key]=!0;return dirtyFieldsFromValues})(defaultValues,formValues,markFieldsDirty(formValues)),getFieldValueAs=(value1,{valueAsNumber,valueAsDate,setValueAs})=>isUndefined(value1)?value1:valueAsNumber?""===value1?NaN:value1?+value1:value1:valueAsDate&&isString(value1)?new Date(value1):setValueAs?setValueAs(value1):value1;function getFieldValue(_f){let ref=_f.ref;return(_f.refs?_f.refs.every(ref=>ref.disabled):ref.disabled)?void 0:isFileInput(ref)?ref.files:isRadioInput(ref)?getRadioValue(_f.refs).value:isMultipleSelect(ref)?[...ref.selectedOptions].map(({value:value1})=>value1):isCheckBoxInput(ref)?getCheckboxValue(_f.refs).value:getFieldValueAs(isUndefined(ref.value)?_f.ref.value:ref.value,_f)}var getResolverOptions=(fieldsNames,_fields,criteriaMode,shouldUseNativeValidation)=>{let fields={};for(let name of fieldsNames){let field=get(_fields,name);field&&set(fields,name,field._f)}return{criteriaMode,names:[...fieldsNames],fields,shouldUseNativeValidation}},getRuleValue=rule=>isUndefined(rule)?void 0:isRegex(rule)?rule.source:isObject(rule)?isRegex(rule.value)?rule.value.source:rule.value:rule,hasValidation=options=>options.mount&&(options.required||options.min||options.max||options.maxLength||options.minLength||options.pattern||options.validate);function schemaErrorLookup(errors,_fields,name){let error=get(errors,name);if(error||isKey(name))return{error,name};let names=name.split(".");for(;names.length;){let fieldName=names.join("."),field=get(_fields,fieldName),foundError=get(errors,fieldName);if(field&&!Array.isArray(field)&&name!==fieldName)break;if(foundError&&foundError.type)return{name:fieldName,error:foundError};names.pop()}return{name}}var skipValidation=(isBlurEvent,isTouched,isSubmitted,reValidateMode,mode)=>!mode.isOnAll&&(!isSubmitted&&mode.isOnTouch?!(isTouched||isBlurEvent):(isSubmitted?reValidateMode.isOnBlur:mode.isOnBlur)?!isBlurEvent:(isSubmitted?!reValidateMode.isOnChange:!mode.isOnChange)||isBlurEvent),unsetEmptyArray=(ref,name)=>!compact(get(ref,name)).length&&unset(ref,name);let defaultOptions={mode:VALIDATION_MODE.onSubmit,reValidateMode:VALIDATION_MODE.onChange,shouldFocusError:!0};function useForm(props={}){let _formControl=react__WEBPACK_IMPORTED_MODULE_0__.useRef(),[formState,updateFormState]=react__WEBPACK_IMPORTED_MODULE_0__.useState({isDirty:!1,isValidating:!1,isSubmitted:!1,isSubmitting:!1,isSubmitSuccessful:!1,isValid:!1,submitCount:0,dirtyFields:{},touchedFields:{},errors:{},defaultValues:props.defaultValues});_formControl.current||(_formControl.current={...function(props={}){let delayErrorCallback,_options={...defaultOptions,...props},_formState={submitCount:0,isDirty:!1,isValidating:!1,isSubmitted:!1,isSubmitting:!1,isSubmitSuccessful:!1,isValid:!1,touchedFields:{},dirtyFields:{},errors:{}},_fields={},_defaultValues=cloneObject(_options.defaultValues)||{},_formValues=_options.shouldUnregister?{}:cloneObject(_defaultValues),_stateFlags={action:!1,mount:!1,watch:!1},_names={mount:new Set,unMount:new Set,array:new Set,watch:new Set},timer=0,validateFields={},_proxyFormState={isDirty:!1,dirtyFields:!1,touchedFields:!1,isValidating:!1,isValid:!1,errors:!1},_subjects={watch:createSubject(),array:createSubject(),state:createSubject()},validationModeBeforeSubmit=getValidationModes(_options.mode),validationModeAfterSubmit=getValidationModes(_options.reValidateMode),shouldDisplayAllAssociatedErrors=_options.criteriaMode===VALIDATION_MODE.all,debounce=callback=>wait=>{clearTimeout(timer),timer=window.setTimeout(callback,wait)},_updateValid=async()=>{let isValid=!1;return _proxyFormState.isValid&&(isValid=_options.resolver?isEmptyObject((await _executeSchema()).errors):await executeBuiltInValidation(_fields,!0))!==_formState.isValid&&(_formState.isValid=isValid,_subjects.state.next({isValid})),isValid},_updateFieldArray=(name,values=[],method,args,shouldSetValues=!0,shouldUpdateFieldsAndState=!0)=>{if(args&&method){if(_stateFlags.action=!0,shouldUpdateFieldsAndState&&Array.isArray(get(_fields,name))){let fieldValues=method(get(_fields,name),args.argA,args.argB);shouldSetValues&&set(_fields,name,fieldValues)}if(_proxyFormState.errors&&shouldUpdateFieldsAndState&&Array.isArray(get(_formState.errors,name))){let errors=method(get(_formState.errors,name),args.argA,args.argB);shouldSetValues&&set(_formState.errors,name,errors),unsetEmptyArray(_formState.errors,name)}if(_proxyFormState.touchedFields&&shouldUpdateFieldsAndState&&Array.isArray(get(_formState.touchedFields,name))){let touchedFields=method(get(_formState.touchedFields,name),args.argA,args.argB);shouldSetValues&&set(_formState.touchedFields,name,touchedFields)}_proxyFormState.dirtyFields&&(_formState.dirtyFields=getDirtyFields(_defaultValues,_formValues)),_subjects.state.next({isDirty:_getDirty(name,values),dirtyFields:_formState.dirtyFields,errors:_formState.errors,isValid:_formState.isValid})}else set(_formValues,name,values)},updateErrors=(name,error)=>{set(_formState.errors,name,error),_subjects.state.next({errors:_formState.errors})},updateValidAndValue=(name,shouldSkipSetValueAs,value1,ref)=>{let field=get(_fields,name);if(field){let defaultValue=get(_formValues,name,isUndefined(value1)?get(_defaultValues,name):value1);isUndefined(defaultValue)||ref&&ref.defaultChecked||shouldSkipSetValueAs?set(_formValues,name,shouldSkipSetValueAs?defaultValue:getFieldValue(field._f)):setFieldValue(name,defaultValue),_stateFlags.mount&&_updateValid()}},updateTouchAndDirty=(name,fieldValue,isBlurEvent,shouldDirty,shouldRender)=>{let isFieldDirty=!1,output={name},isPreviousFieldTouched=get(_formState.touchedFields,name);if(_proxyFormState.isDirty){let isPreviousFormDirty=_formState.isDirty;_formState.isDirty=output.isDirty=_getDirty(),isFieldDirty=isPreviousFormDirty!==output.isDirty}if(_proxyFormState.dirtyFields&&(!isBlurEvent||shouldDirty)){let isPreviousFieldDirty=get(_formState.dirtyFields,name),isCurrentFieldPristine=deepEqual(get(_defaultValues,name),fieldValue);isCurrentFieldPristine?unset(_formState.dirtyFields,name):set(_formState.dirtyFields,name,!0),output.dirtyFields=_formState.dirtyFields,isFieldDirty=isFieldDirty||isPreviousFieldDirty!==get(_formState.dirtyFields,name)}return isBlurEvent&&!isPreviousFieldTouched&&(set(_formState.touchedFields,name,isBlurEvent),output.touchedFields=_formState.touchedFields,isFieldDirty=isFieldDirty||_proxyFormState.touchedFields&&isPreviousFieldTouched!==isBlurEvent),isFieldDirty&&shouldRender&&_subjects.state.next(output),isFieldDirty?output:{}},shouldRenderByError=(name,isValid,error,fieldState)=>{let previousFieldError=get(_formState.errors,name),shouldUpdateValid=_proxyFormState.isValid&&isBoolean(isValid)&&_formState.isValid!==isValid;if(props.delayError&&error?(delayErrorCallback=debounce(()=>updateErrors(name,error)))(props.delayError):(clearTimeout(timer),delayErrorCallback=null,error?set(_formState.errors,name,error):unset(_formState.errors,name)),(error?!deepEqual(previousFieldError,error):previousFieldError)||!isEmptyObject(fieldState)||shouldUpdateValid){let updatedFormState={...fieldState,...shouldUpdateValid&&isBoolean(isValid)?{isValid}:{},errors:_formState.errors,name};_formState={..._formState,...updatedFormState},_subjects.state.next(updatedFormState)}validateFields[name]--,_proxyFormState.isValidating&&!Object.values(validateFields).some(v=>v)&&(_subjects.state.next({isValidating:!1}),validateFields={})},_executeSchema=async name=>_options.resolver?await _options.resolver({..._formValues},_options.context,getResolverOptions(name||_names.mount,_fields,_options.criteriaMode,_options.shouldUseNativeValidation)):{},executeSchemaAndUpdateState=async names=>{let{errors}=await _executeSchema();if(names)for(let name of names){let error=get(errors,name);error?set(_formState.errors,name,error):unset(_formState.errors,name)}else _formState.errors=errors;return errors},executeBuiltInValidation=async(fields,shouldOnlyCheckValid,context={valid:!0})=>{for(let name in fields){let field=fields[name];if(field){let{_f,...fieldValue}=field;if(_f){let isFieldArrayRoot=_names.array.has(_f.name),fieldError=await validateField(field,get(_formValues,_f.name),shouldDisplayAllAssociatedErrors,_options.shouldUseNativeValidation,isFieldArrayRoot);if(fieldError[_f.name]&&(context.valid=!1,shouldOnlyCheckValid))break;shouldOnlyCheckValid||(get(fieldError,_f.name)?isFieldArrayRoot?updateFieldArrayRootError(_formState.errors,fieldError,_f.name):set(_formState.errors,_f.name,fieldError[_f.name]):unset(_formState.errors,_f.name))}fieldValue&&await executeBuiltInValidation(fieldValue,shouldOnlyCheckValid,context)}}return context.valid},_removeUnmounted=()=>{for(let name of _names.unMount){let field=get(_fields,name);field&&(field._f.refs?field._f.refs.every(ref=>!live(ref)):!live(field._f.ref))&&unregister(name)}_names.unMount=new Set},_getDirty=(name,data)=>(name&&data&&set(_formValues,name,data),!deepEqual(getValues(),_defaultValues)),_getWatch=(names,defaultValue,isGlobal)=>{let fieldValues={..._stateFlags.mount?_formValues:isUndefined(defaultValue)?_defaultValues:isString(names)?{[names]:defaultValue}:defaultValue};return generateWatchOutput(names,_names,fieldValues,isGlobal)},_getFieldArray=name=>compact(get(_stateFlags.mount?_formValues:_defaultValues,name,props.shouldUnregister?get(_defaultValues,name,[]):[])),setFieldValue=(name,value1,options={})=>{let field=get(_fields,name),fieldValue=value1;if(field){let fieldReference=field._f;fieldReference&&(fieldReference.disabled||set(_formValues,name,getFieldValueAs(value1,fieldReference)),fieldValue=isWeb&&isHTMLElement(fieldReference.ref)&&isNullOrUndefined(value1)?"":value1,isMultipleSelect(fieldReference.ref)?[...fieldReference.ref.options].forEach(optionRef=>optionRef.selected=fieldValue.includes(optionRef.value)):fieldReference.refs?isCheckBoxInput(fieldReference.ref)?fieldReference.refs.length>1?fieldReference.refs.forEach(checkboxRef=>(!checkboxRef.defaultChecked||!checkboxRef.disabled)&&(checkboxRef.checked=Array.isArray(fieldValue)?!!fieldValue.find(data=>data===checkboxRef.value):fieldValue===checkboxRef.value)):fieldReference.refs[0]&&(fieldReference.refs[0].checked=!!fieldValue):fieldReference.refs.forEach(radioRef=>radioRef.checked=radioRef.value===fieldValue):isFileInput(fieldReference.ref)?fieldReference.ref.value="":(fieldReference.ref.value=fieldValue,fieldReference.ref.type||_subjects.watch.next({name})))}(options.shouldDirty||options.shouldTouch)&&updateTouchAndDirty(name,fieldValue,options.shouldTouch,options.shouldDirty,!0),options.shouldValidate&&trigger(name)},setValues=(name,value1,options)=>{for(let fieldKey in value1){let fieldValue=value1[fieldKey],fieldName=`${name}.${fieldKey}`,field=get(_fields,fieldName);!_names.array.has(name)&&isPrimitive(fieldValue)&&(!field||field._f)||isDateObject(fieldValue)?setFieldValue(fieldName,fieldValue,options):setValues(fieldName,fieldValue,options)}},setValue=(name,value1,options={})=>{let field=get(_fields,name),isFieldArray=_names.array.has(name),cloneValue=cloneObject(value1);set(_formValues,name,cloneValue),isFieldArray?(_subjects.array.next({name,values:_formValues}),(_proxyFormState.isDirty||_proxyFormState.dirtyFields)&&options.shouldDirty&&(_formState.dirtyFields=getDirtyFields(_defaultValues,_formValues),_subjects.state.next({name,dirtyFields:_formState.dirtyFields,isDirty:_getDirty(name,cloneValue)}))):!field||field._f||isNullOrUndefined(cloneValue)?setFieldValue(name,cloneValue,options):setValues(name,cloneValue,options),isWatched(name,_names)&&_subjects.state.next({}),_subjects.watch.next({name})},onChange=async event=>{let target=event.target,name=target.name,field=get(_fields,name);if(field){let error,isValid;let fieldValue=target.type?getFieldValue(field._f):getEventValue(event),isBlurEvent=event.type===EVENTS.BLUR||event.type===EVENTS.FOCUS_OUT,shouldSkipValidation=!hasValidation(field._f)&&!_options.resolver&&!get(_formState.errors,name)&&!field._f.deps||skipValidation(isBlurEvent,get(_formState.touchedFields,name),_formState.isSubmitted,validationModeAfterSubmit,validationModeBeforeSubmit),watched=isWatched(name,_names,isBlurEvent);set(_formValues,name,fieldValue),isBlurEvent?(field._f.onBlur&&field._f.onBlur(event),delayErrorCallback&&delayErrorCallback(0)):field._f.onChange&&field._f.onChange(event);let fieldState=updateTouchAndDirty(name,fieldValue,isBlurEvent,!1),shouldRender=!isEmptyObject(fieldState)||watched;if(isBlurEvent||_subjects.watch.next({name,type:event.type}),shouldSkipValidation)return _proxyFormState.isValid&&_updateValid(),shouldRender&&_subjects.state.next({name,...watched?{}:fieldState});if(!isBlurEvent&&watched&&_subjects.state.next({}),validateFields[name]=validateFields[name]?validateFields[name]+1:1,_subjects.state.next({isValidating:!0}),_options.resolver){let{errors}=await _executeSchema([name]),previousErrorLookupResult=schemaErrorLookup(_formState.errors,_fields,name),errorLookupResult=schemaErrorLookup(errors,_fields,previousErrorLookupResult.name||name);error=errorLookupResult.error,name=errorLookupResult.name,isValid=isEmptyObject(errors)}else error=(await validateField(field,get(_formValues,name),shouldDisplayAllAssociatedErrors,_options.shouldUseNativeValidation))[name],_updateValid();field._f.deps&&trigger(field._f.deps),shouldRenderByError(name,isValid,error,fieldState)}},trigger=async(name,options={})=>{let isValid,validationResult;let fieldNames=convertToArrayPayload(name);if(_subjects.state.next({isValidating:!0}),_options.resolver){let errors=await executeSchemaAndUpdateState(isUndefined(name)?name:fieldNames);isValid=isEmptyObject(errors),validationResult=name?!fieldNames.some(name=>get(errors,name)):isValid}else name?((validationResult=(await Promise.all(fieldNames.map(async fieldName=>{let field=get(_fields,fieldName);return await executeBuiltInValidation(field&&field._f?{[fieldName]:field}:field)}))).every(Boolean))||_formState.isValid)&&_updateValid():validationResult=isValid=await executeBuiltInValidation(_fields);return _subjects.state.next({...!isString(name)||_proxyFormState.isValid&&isValid!==_formState.isValid?{}:{name},..._options.resolver||!name?{isValid}:{},errors:_formState.errors,isValidating:!1}),options.shouldFocus&&!validationResult&&focusFieldBy(_fields,key=>key&&get(_formState.errors,key),name?fieldNames:_names.mount),validationResult},getValues=fieldNames=>{let values={..._defaultValues,..._stateFlags.mount?_formValues:{}};return isUndefined(fieldNames)?values:isString(fieldNames)?get(values,fieldNames):fieldNames.map(name=>get(values,name))},getFieldState=(name,formState)=>({invalid:!!get((formState||_formState).errors,name),isDirty:!!get((formState||_formState).dirtyFields,name),isTouched:!!get((formState||_formState).touchedFields,name),error:get((formState||_formState).errors,name)}),clearErrors=name=>{name?convertToArrayPayload(name).forEach(inputName=>unset(_formState.errors,inputName)):_formState.errors={},_subjects.state.next({errors:_formState.errors})},setError=(name,error,options)=>{let ref=(get(_fields,name,{_f:{}})._f||{}).ref;set(_formState.errors,name,{...error,ref}),_subjects.state.next({name,errors:_formState.errors,isValid:!1}),options&&options.shouldFocus&&ref&&ref.focus&&ref.focus()},watch=(name,defaultValue)=>isFunction(name)?_subjects.watch.subscribe({next:info=>name(_getWatch(void 0,defaultValue),info)}):_getWatch(name,defaultValue,!0),unregister=(name,options={})=>{for(let fieldName of name?convertToArrayPayload(name):_names.mount)_names.mount.delete(fieldName),_names.array.delete(fieldName),get(_fields,fieldName)&&(options.keepValue||(unset(_fields,fieldName),unset(_formValues,fieldName)),options.keepError||unset(_formState.errors,fieldName),options.keepDirty||unset(_formState.dirtyFields,fieldName),options.keepTouched||unset(_formState.touchedFields,fieldName),_options.shouldUnregister||options.keepDefaultValue||unset(_defaultValues,fieldName));_subjects.watch.next({}),_subjects.state.next({..._formState,...options.keepDirty?{isDirty:_getDirty()}:{}}),options.keepIsValid||_updateValid()},register=(name,options={})=>{let field=get(_fields,name),disabledIsDefined=isBoolean(options.disabled);return set(_fields,name,{...field||{},_f:{...field&&field._f?field._f:{ref:{name}},name,mount:!0,...options}}),_names.mount.add(name),field?disabledIsDefined&&set(_formValues,name,options.disabled?void 0:get(_formValues,name,getFieldValue(field._f))):updateValidAndValue(name,!0,options.value),{...disabledIsDefined?{disabled:options.disabled}:{},..._options.shouldUseNativeValidation?{required:!!options.required,min:getRuleValue(options.min),max:getRuleValue(options.max),minLength:getRuleValue(options.minLength),maxLength:getRuleValue(options.maxLength),pattern:getRuleValue(options.pattern)}:{},name,onChange,onBlur:onChange,ref(ref){if(ref){register(name,options),field=get(_fields,name);let fieldRef=isUndefined(ref.value)&&ref.querySelectorAll&&ref.querySelectorAll("input,select,textarea")[0]||ref,radioOrCheckbox=isRadioOrCheckbox(fieldRef),refs=field._f.refs||[];(radioOrCheckbox?refs.find(option=>option===fieldRef):fieldRef===field._f.ref)||(set(_fields,name,{_f:{...field._f,...radioOrCheckbox?{refs:[...refs.filter(live),fieldRef,...Array.isArray(get(_defaultValues,name))?[{}]:[]],ref:{type:fieldRef.type,name}}:{ref:fieldRef}}}),updateValidAndValue(name,!1,void 0,fieldRef))}else(field=get(_fields,name,{}))._f&&(field._f.mount=!1),(_options.shouldUnregister||options.shouldUnregister)&&!(isNameInFieldArray(_names.array,name)&&_stateFlags.action)&&_names.unMount.add(name)}}},_focusError=()=>_options.shouldFocusError&&focusFieldBy(_fields,key=>key&&get(_formState.errors,key),_names.mount),handleSubmit=(onValid,onInvalid)=>async e=>{e&&(e.preventDefault&&e.preventDefault(),e.persist&&e.persist());let hasNoPromiseError=!0,fieldValues=cloneObject(_formValues);_subjects.state.next({isSubmitting:!0});try{if(_options.resolver){let{errors,values}=await _executeSchema();_formState.errors=errors,fieldValues=values}else await executeBuiltInValidation(_fields);isEmptyObject(_formState.errors)?(_subjects.state.next({errors:{},isSubmitting:!0}),await onValid(fieldValues,e)):(onInvalid&&await onInvalid({..._formState.errors},e),_focusError())}catch(err){throw hasNoPromiseError=!1,err}finally{_formState.isSubmitted=!0,_subjects.state.next({isSubmitted:!0,isSubmitting:!1,isSubmitSuccessful:isEmptyObject(_formState.errors)&&hasNoPromiseError,submitCount:_formState.submitCount+1,errors:_formState.errors})}},resetField=(name,options={})=>{get(_fields,name)&&(isUndefined(options.defaultValue)?setValue(name,get(_defaultValues,name)):(setValue(name,options.defaultValue),set(_defaultValues,name,options.defaultValue)),options.keepTouched||unset(_formState.touchedFields,name),options.keepDirty||(unset(_formState.dirtyFields,name),_formState.isDirty=options.defaultValue?_getDirty(name,get(_defaultValues,name)):_getDirty()),!options.keepError&&(unset(_formState.errors,name),_proxyFormState.isValid&&_updateValid()),_subjects.state.next({..._formState}))},_reset=(formValues,keepStateOptions={})=>{let updatedValues=formValues||_defaultValues,cloneUpdatedValues=cloneObject(updatedValues),values=formValues&&!isEmptyObject(formValues)?cloneUpdatedValues:_defaultValues;if(keepStateOptions.keepDefaultValues||(_defaultValues=updatedValues),!keepStateOptions.keepValues){if(keepStateOptions.keepDirtyValues)for(let fieldName of _names.mount)get(_formState.dirtyFields,fieldName)?set(values,fieldName,get(_formValues,fieldName)):setValue(fieldName,get(values,fieldName));else{if(isWeb&&isUndefined(formValues))for(let name of _names.mount){let field=get(_fields,name);if(field&&field._f){let fieldReference=Array.isArray(field._f.refs)?field._f.refs[0]:field._f.ref;if(isHTMLElement(fieldReference)){let form=fieldReference.closest("form");if(form){form.reset();break}}}}_fields={}}_formValues=props.shouldUnregister?keepStateOptions.keepDefaultValues?cloneObject(_defaultValues):{}:cloneUpdatedValues,_subjects.array.next({values}),_subjects.watch.next({values})}_names={mount:new Set,unMount:new Set,array:new Set,watch:new Set,watchAll:!1,focus:""},_stateFlags.mount=!_proxyFormState.isValid||!!keepStateOptions.keepIsValid,_stateFlags.watch=!!props.shouldUnregister,_subjects.state.next({submitCount:keepStateOptions.keepSubmitCount?_formState.submitCount:0,isDirty:keepStateOptions.keepDirty||keepStateOptions.keepDirtyValues?_formState.isDirty:!!(keepStateOptions.keepDefaultValues&&!deepEqual(formValues,_defaultValues)),isSubmitted:!!keepStateOptions.keepIsSubmitted&&_formState.isSubmitted,dirtyFields:keepStateOptions.keepDirty||keepStateOptions.keepDirtyValues?_formState.dirtyFields:keepStateOptions.keepDefaultValues&&formValues?getDirtyFields(_defaultValues,formValues):{},touchedFields:keepStateOptions.keepTouched?_formState.touchedFields:{},errors:keepStateOptions.keepErrors?_formState.errors:{},isSubmitting:!1,isSubmitSuccessful:!1})},reset=(formValues,keepStateOptions)=>_reset(isFunction(formValues)?formValues(_formValues):formValues,keepStateOptions),setFocus=(name,options={})=>{let field=get(_fields,name),fieldReference=field&&field._f;if(fieldReference){let fieldRef=fieldReference.refs?fieldReference.refs[0]:fieldReference.ref;fieldRef.focus&&(fieldRef.focus(),options.shouldSelect&&fieldRef.select())}};return{control:{register,unregister,getFieldState,_executeSchema,_focusError,_getWatch,_getDirty,_updateValid,_removeUnmounted,_updateFieldArray,_getFieldArray,_subjects,_proxyFormState,get _fields(){return _fields},get _formValues(){return _formValues},get _stateFlags(){return _stateFlags},set _stateFlags(value){_stateFlags=value},get _defaultValues(){return _defaultValues},get _names(){return _names},set _names(value){_names=value},get _formState(){return _formState},set _formState(value){_formState=value},get _options(){return _options},set _options(value){_options={..._options,...value}}},trigger,register,handleSubmit,watch,setValue,getValues,reset,resetField,clearErrors,unregister,setError,setFocus,getFieldState}}(props),formState});let control=_formControl.current.control;return control._options=props,!function(props){let _props=react__WEBPACK_IMPORTED_MODULE_0__.useRef(props);_props.current=props,react__WEBPACK_IMPORTED_MODULE_0__.useEffect(()=>{let subscription=!props.disabled&&_props.current.subject.subscribe({next:_props.current.callback});return()=>{subscription&&subscription.unsubscribe()}},[props.disabled])}({subject:control._subjects.state,callback:react__WEBPACK_IMPORTED_MODULE_0__.useCallback(value1=>{shouldRenderFormState(value1,control._proxyFormState,!0)&&(control._formState={...control._formState,...value1},updateFormState({...control._formState}))},[control])}),react__WEBPACK_IMPORTED_MODULE_0__.useEffect(()=>{control._stateFlags.mount||(control._proxyFormState.isValid&&control._updateValid(),control._stateFlags.mount=!0),control._stateFlags.watch&&(control._stateFlags.watch=!1,control._subjects.state.next({})),control._removeUnmounted()}),react__WEBPACK_IMPORTED_MODULE_0__.useEffect(()=>{formState.submitCount&&control._focusError()},[control,formState.submitCount]),_formControl.current.formState=getProxyFormState(formState,control),_formControl.current}}}]);